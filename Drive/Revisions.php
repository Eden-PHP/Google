<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Drive Revisions Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Drive_Revisions extends Base
{
	const URL_REVISIONS_LIST	= 'https://www.googleapis.com/drive/v2/files/%s/revisions';
	const URL_REVISIONS_GET		= 'https://www.googleapis.com/drive/v2/files/%s/revisions/%s';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token = $token; 
	}
	
	/**
	 * Removes a revision
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function delete($fileId, $revisionId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_REVISIONS_GET, $fileId, $revisionId));
	}
	
	/**
	 * Lists a file's revisions
	 *
	 * @param string
	 * @return array
	 */
	public function getList($fileId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_REVISIONS_LIST, $fileId));
	}
	
	/**
	 * Gets a specific revision
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getSpecific($fileId, $revisionId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->getResponse(sprintf(self::URL_REVISIONS_GET, $fileId, $revisionId));
	}
	
	/**
	 * Updates a revision. This method supports patch semantics
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function patch($fileId, $revisionId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
			
		return $this->patch(sprintf(self::URL_PERMISSIONS_GET, $fileId, $revisionId), $this->query);
	}
	
	/**
	 * Whether this revision is pinned to prevent automatic purging. 
	 * This will only be populated on files with content stored in Drive.
	 *
	 * @return this
	 */
	public function setPinned()
	{
		$this->query[self::PINNED] = true;
		
		return $this;
	}
	
	/**
	 * Whether subsequent revisions will be automatically republished.
	 *
	 * @return this
	 */
	public function setPublishAuto()
	{
		$this->query[self::PUBLICHED_AUTO] = true;
		
		return $this;
	}	/**
	 * Whether this revision is published. This is only populated for Google Docs.
	 *
	 * @return this
	 */
	public function setPublished()
	{
		$this->query[self::PUBLISHED] = true;
		
		return $this;
	}
	
	/**
	 * A link to the published revision.
	 *
	 * @param string
	 * @return this
	 */
	public function setPublishedLink($publishedLink)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::PUBLISHED_LINK] = $publishedLink;
		
		return $this;
	}
	
	/**
	 * Whether this revision is published outside the domain.
	 *
	 * @return this
	 */
	public function setPublishedOutsideDomain()
	{
		$this->query[self::OUTSIDE_DOMAIN] = true;
		
		return $this;
	}
	
	/**
	 * Updates a revision.
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function update($fileId, $revisionId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
			
		return $this->put(sprintf(self::URL_PERMISSIONS_GET, $fileId, $revisionId), $this->query);
	}
}