<?php //--> 
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Drive Changes Class
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Drive_Changes extends Base
{
	const URL_DRIVE_CHANGES_LIST	= 'https://www.googleapis.com/drive/v2/changes';
	const URL_DRIVE_CHANGES_GET		= 'https://www.googleapis.com/drive/v2/changes/%s';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token = $token; 
	}
		
	/**
	 * Lists the changes for a user.
	 *
	 * @return array
	 */
	public function getList()
	{
		return $this->getResponse(self::URL_DRIVE_CHANGES_LIST);
	}
	 
	/**
	 * Gets a specific changes.
	 *
	 * @param string The ID of the change
	 * @return array
	 */
	public function getSpecific($changeId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_DRIVE_CHANGES_GET, $changeId));
	}
}