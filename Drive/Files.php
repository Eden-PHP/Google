<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Drive Files Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Drive_Files extends Base
{
	const URL_DRIVE_LIST	= 'https://www.googleapis.com/drive/v2/files';
	const URL_DRIVE_GET		= 'https://www.googleapis.com/drive/v2/files/%s';
	const URL_DRIVE_TRASH	= 'https://www.googleapis.com/drive/v2/files/%s/trash';
	const URL_DRIVE_UNTRASH	= 'https://www.googleapis.com/drive/v2/files/%s/untrash';
	const URL_DRIVE_TOUCH	= 'https://www.googleapis.com/drive/v2/files/%s/touch';
	const URL_UPLOAD		= 'https://www.googleapis.com/upload/drive/v2/files/%s?uploadType=media';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token = $token; 
	}
	
	/**
	 * Creates a copy of the specified file
	 *
	 * @param string
	 * @return array
	 */
	public function copyFile($fileId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->post(sprintf(self::URL_DRIVE_COPY, $fileId));
	}
	
	/**
	 * This method supports media upload. 
	 * Uploaded files must conform to these constraints: 
	 *
	 * @param string The title of the this file, must put exact extension name, ex. filename.pdf
	 * @return array The MIME type of the file. ex. application/pdf, image/jpeg
	 */
	public function create($title, $mimeType, $data)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');
		
		$this->query[self::TITLE]		= $title;
		$this->query[self::MIME_TYPE]	= $mimeType;
		
		//request a file id
		$fileId =  $this->post(self::URL_DRIVE_LIST, $this->query);
		
		//if there is no error
		if(isset($fileId['id']) && !empty($fileId['id'])) {
			//upload the files
			return $this->upload($data, $fileId['id']);
		//else there must be a error
		} else {
			//return the error
			return $fileId;
		}
		
	}
	
	/**
	 * Updates file metadata and/or content.
	 *
	 * @param string
	 * @return array
	 */
	public function delete($fileId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->delete(sprintf(self::URL_DRIVE_GET, $fileId));
	}
	
	/**
	 * Returns the color definitions for 
	 * calendars and events. 
	 *
	 * @return array
	 */
	public function getList()
	{
		return $this->getResponse(self::URL_DRIVE_LIST);
	}
	
	/**
	 * Gets a file's metadata by ID.
	 *
	 * @param string
	 * @return array
	 */
	public function getSpecific($fileId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_DRIVE_GET, $fileId));
	}
	
	/**
	 * Updates file metadata and/or content.
	 * This method supports patch semantics.
	 *
	 * @return array
	 */
	public function patch($fileId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->patch(sprintf(self::URL_DRIVE_GET, $fileId), $this->query);
	}
	
	/**
	 * A short description of the file.
	 *
	 * @param string
	 * @return this
	 */
	public function setDescription($description)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::DESCRIPTION] = $description;
		
		return $this;
	}
	
	/**
	 * The MIME type of the file.
	 *
	 * @param string
	 * @return this
	 */
	public function setMimeType($mimeType)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::MIME_TYPE] = $mimeType;
		
		return $this;
	}
	
	/**
	 * Last time this file was viewed by the user 
	 * (formatted RFC 3339 timestamp).
	 *
	 * @param string|int 
	 * @return this
	 */
	public function setLastViewedDate($lastViewedDate)
	{
		//argument 1 must be a string or integer
		Argument::i()->test(1, 'string', 'int');
		
		if(is_string($lastViewedByMeDate)) {
			$lastViewedByMeDate = strtotime($lastViewedByMeDate);
		}
		
		$this->query[self::LAST_VIEW]['dateTime'] = date('c', $lastViewedByMeDate);
		
		return $this;
	}
	
	/**
	 * Last time this file was modified by anyone (formatted RFC 3339 timestamp). 
	 * This is only mutable on update when the setModifiedDate parameter is set.
	 *
	 * @param string|int
	 * @return this
	 */
	public function setModifiedDate($modifiedDate)
	{
		//argument 1 must be a string or integer
		Argument::i()->test(1, 'string', 'int');
		
		if(is_string($modifiedDate)) {
			$modifiedDate = strtotime($modifiedDate);
		}
		
		$this->query[self::MODIFIED_DATE]['dateTime'] = date('c', $modifiedDate);
		
		return $this;
	}
	
	/**
	 * If ocr is true, hints at the language 
	 * to use. Valid values are ISO 639-1 codes. 
	 *
	 * @param string
	 * @return this
	 */
	public function setOcrLanguage($ocrLanguage)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::OCR_LANGUAGE] = $ocrLanguage;
		
		return $this;
	}
	
	/**
	 * The language of the original file to be translated. 
	 *
	 * @param string
	 * @return this
	 */
	public function setSourceLanguage($sourceLanguage)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::SOURCE_LANGUAGE] = $sourceLanguage;
		
		return $this;
	}
	
	/**
	 * Target language to translate the 
	 * file to. If no sourceLanguage is provided, 
	 * the API will attempt to detect the language. 
	 *
	 * @param string
	 * @return this
	 */
	public function setTargetLanguage($targetLanguage)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::TARGET_LANGUAGE] = $targetLanguage;
		
		return $this;
	}
	
	/**
	 * The language of the timed text. 
	 *
	 * @param string
	 * @return this
	 */
	public function setTimedTextLanguage($timedTextLanguage)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::TEXT_LANGUAGE] = $timedTextLanguageE;
		
		return $this;
	}
	
	/**
	 * The timed text track name. 
	 *
	 * @param string
	 * @return this
	 */
	public function setTimedTextTrackName($timedTextTrackName)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::TEXT_TRACKNAME] = $timedTextTrackName;
		
		return $this;
	}
	
	/**
	 * The title of the this file. Used 
	 * to identify file or folder name.
	 *
	 * @param string
	 * @return this
	 */
	public function setTitle($title)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::TITLE] = $title;
		
		return $this;
	}
	
	/**
	 * Whether to convert this file 
	 * to the corresponding Google Docs format. 
	 *
	 * @return this
	 */
	public function convert()
	{
		$this->query[self::CONVERT] = true;
		
		return $this;
	}
	
	/**
	 * Whether a blob upload should create a new revision. 
	 * If false, the blob data in the current head revision will be replaced. 
	 *
	 * @return this
	 */
	public function setToNewRevision()
	{
		$this->query[self::NEW_REVISION] = true;
		
		return $this;
	}
	
	/**
	 * Whether to attempt OCR on .jpg, .png, or .gif uploads. 
	 *
	 * @return this
	 */
	public function setToOcr()
	{
		$this->query[self::OCR] = true;
		
		return $this;
	}
	
	/**
	 * Whether to pin the head revision of the uploaded file. 
	 *
	 * @return this
	 */
	public function setToPinned()
	{
		$this->query[self::PINNED] = true;
		
		return $this;
	}
	
	/**
	 * Moves a file to the trash.
	 *
	 * @param string
	 * @return array
	 */
	public function trash($fileId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->post(sprintf(self::URL_DRIVE_TRASH, $fileId));
	}
	
	/**
	 * Set the file's updated time to the current server time
	 *
	 * @param string
	 * @return array
	 */
	public function touchFile($fileId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->post(sprintf(self::URL_DRIVE_TOUCH, $fileId));
	}
	
	/**
	 * Restores a file from the trash
	 *
	 * @param string
	 * @return array
	 */
	public function untrash()
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->post(sprintf(self::URL_DRIVE_UNTRASH, $fileId));
	}
	
	 /**
	 * Updates file metadata and/or content.
	 *
	 * @param string
	 * @return array
	 */
	public function update($fileId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->post(sprintf(self::URL_DRIVE_GET, $fileId), $this->query);
	}
	
	/**
	 * Upload file data
	 *
	 * @param string ex. $_FILES['INPUT_NAME']['tmp_name']
	 * @param string File id
	 * @return array
	 */
	public function upload($data, $id)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->put(sprintf(self::URL_UPLOAD, $id), $data);
	}
}