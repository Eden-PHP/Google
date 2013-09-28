<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google youtube constacts
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Contacts extends Base
{ 
	const URL_YOUTUBE_CONTACTS		= 'https://gdata.youtube.com/feeds/api/users/%s/contacts';
	const URL_YOUTUBE_CONTACTS_GET	= 'https://gdata.youtube.com/feeds/api/users/%s/contacts/%s';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token, $developerId)
	{
		//argument test
		Argument::i()
			->test(1, 'string')
			->test(2, 'string');
			
		$this->token 		= $token;
		$this->developerId = $developerId; 
	}
	
	/**
	 * Retrieve all user's contacts
	 *
	 * @param string
	 * @return array
	 */
	public function getList($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_CONTACTS, $userId), $this->query);
	}
	
	/**
	 * Retrieve specific user's contacts
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getSpecific($userName, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
			
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_CONTACTS_GET, $userId, $userName), $this->query);
	}
	
	/**
	 * Delete a contact
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function delete($userName, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_YOUTUBE_CONTACTS_GET, $userId, $userName));
	}
	
	/**
	 * Add contacts
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function addContacts($userName, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');

		//make a xml template file
		$query = Template::i()
			->set(self::USER_NAME, $userName)
			->parsePHP(dirname(__FILE__).'/template/activate.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_CONTACTS, $userId), $query);
	}
	
	/**
	 * Update contacts
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function updateContacts($userName, $status, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');
		
		//if the input value is not allowed
		if(!in_array($status, array('accepted', 'rejected'))) {
			//throw error
			Argument::i()
				->setMessage(Argument::INVALID_STATUS) 
				->addVariable($status)
				->trigger();
		}
		
		//make a xml template file
		$query = Template::i()
			->set(self::STATUS, $status)
			->parsePHP(dirname(__FILE__).'/template/updatecontacts.php');
			
		return $this->put(sprintf(self::URL_YOUTUBE_CONTACTS_GET, $userId, $userName), $query);
	}
}