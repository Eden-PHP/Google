<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google youtube activity
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Activity extends Base
{ 
	const URL_YOUTUBE_EVENT		= 'https://gdata.youtube.com/feeds/api/users/%s/events';
	const URL_YOUTUBE_SUBTIVITY	= 'https://gdata.youtube.com/feeds/api/users/%s/subtivity';
	
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
	 * Retrieve all user's event
	 *
	 * @param string
	 * @return array
	 */
	public function getEvent($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		//populate fields
		$query  = array(
			self::RESPONSE	=> self::JSON_FORMAT,
			self::VERSION	=> self::VERSION);
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_EVENT, $userId), $query);
	}
	
	/**
	 * Retrieve all user's subtivity
	 *
	 * @param string
	 * @return array
	 */
	public function getSubtivity($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		//populate fields
		$query  = array(
			self::RESPONSE	=> self::JSON_FORMAT,
			self::VERSION	=> self::VERSION);
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_SUBTIVITY, $userId), $query);
	}

}