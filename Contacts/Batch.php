<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google contacts batch
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Contacts_Batch extends Base
{
	const URL_CONTACTS_GROUPS_LIST	= 'https://www.google.com/m8/feeds/groups/%s/full';
	const URL_CONTACTS_GROUPS_GET	= 'https://www.google.com/m8/feeds/groups/%s/full/%s';
	/* Protected Properties 
	-------------------------------*/	
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token 	= $token;
	}
		
	/**
	 * Retrieve all group list
	 *
	 * @param string
	 * @return array
	 */
	public function getList($userEmail = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::VERSION] = self::VERSION_THREE;
		
		return $this->getResponse(sprintf(self::URL_CONTACTS_GROUPS_LIST, $userEmail), $this->query);
	}
	
	/**
	 * Retrieve all group list
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function create($title, $description, $info, $userEmail = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string')
			//argument 4 must be a string
			->test(4, 'string');
			
		//populate fields
		$parameters	= array(
			self::TITLE			=> $title,
			self::DESCRIPTION	=> $description,
			self::INFO			=> $info);
		
		//make a xml template
		$query = Template::i()
			->set($parameters)
			->parsePHP(dirname(__FILE__).'/template/addgroups.php');
			
		return $this->post(sprintf(self::URL_CONTACTS_GROUPS_LIST, $userEmail), $query);
	}
	
	/**
	 * Delete a group
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function delete($groupId, $userEmail = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_CONTACTS_GROUPS_GET, $userEmail, $groupId), true);
	}
}