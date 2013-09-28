<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */ 

/**
 * Google youtube subscription
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Subscription extends Base
{ 
	const URL_YOUTUBE_SUBSCRIPTION		= 'https://gdata.youtube.com/feeds/api/users/%s/subscriptions';
	const URL_YOUTUBE_NEW_SUBSCRIPTION	= 'https://gdata.youtube.com/feeds/api/users/%s/newsubscriptionvideos';
	const URL_YOUTUBE_UNSUBSCRIPTION	= 'https://gdata.youtube.com/feeds/api/users/%s/subscriptions/%s';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token, $developerId)
	{
		//argument test
		Argument::i()
			->test(1, 'string')
			->test(2, 'string');
		
		$this->token			= $token; 	
		$this->developerId 	= $developerId; 
	}

	/**
	 * Returns all user subscription
	 *
	 * @param string
	 * @return array
	 */
	public function getList($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_SUBSCRIPTION, $userId), $this->query);
	}
	
	/**
	 * Returns new user subscription
	 *
	 * @param string
	 * @return array
	 */
	public function getNewSubscription($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_NEW_SUBSCRIPTION, $userId), $this->query);
	}
	
	/**
	 * Subscribe to a channel
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function subscribeToChannel($channel, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
	
		//make a xml template
		$query = Template::i()
			->set(self::CHANNEL, $channel)
			->parsePHP(dirname(__FILE__).'/template/subscribe.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_SUBSCRIPTION, $userId), $query);
	}
	
	/**
	 * Subscribe to a users activity
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function subscribeToUser($user, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		//make a xml template
		$query = Template::i()
			->set(self::USER, $user)
			->parsePHP(dirname(__FILE__).'/template/subscribe.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_SUBSCRIPTION, $userId), $query);
	}
	
	/**
	 * Subscribe to a users activity
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function unsubscribe($subscriptionId, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_YOUTUBE_UNSUBSCRIPTION, $userId, $subscriptionId));
	}
}