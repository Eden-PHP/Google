<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */

/**
 * Google youtube channel
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Channel extends Base
{ 
	const URL_YOUTUBE_CHANNEL		= 'https://gdata.youtube.com/feeds/api/channels';
	const URL_YOUTUBE_CHANNEL_FEEDS	= 'https://gdata.youtube.com/feeds/api/channelstandardfeeds/%s';
	const URL_YOUTUBE_REGION		= 'https://gdata.youtube.com/feeds/api/channelstandardfeeds/%s/%s';
	
	/* Public Properties 
	-------------------------------*/
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token = $token; 
	}
	
	/**
	 * Set start index
	 *
	 * @param integer
	 * @return this
	 */
	public function setStartIndex($startIndex)
	{
		//argument 1 must be a integer
		Argument::i()->test(1, 'integer');
		$this->query[self::START_INDEX] = $startIndex;
		
		return $this;
	}
	
	/**
	 * Set start index
	 *
	 * @param integer
	 * @return this
	 */
	public function setMaxResults($maxResults)
	{
		//argument 1 must be a integer
		Argument::i()->test(1, 'integer');
		$this->query[self::MAX_RESULTS] = $maxResults;
		
		return $this;
	}
	
	/**
	 * Returns all feeds this day
	 *
	 * @return this
	 */
	public function setToday()
	{
		$this->query[self::TIME] = 'today';
		
		return $this;
	}
	
	/**
	 * Returns all feeds this week
	 *
	 * @return this
	 */
	public function setThisWeek()
	{
		$this->query[self::TIME] = 'this_week';
		
		return $this;
	}
	
	/**
	 * Returns all feeds this month
	 *
	 * @return this
	 */
	public function setThisMonth()
	{
		$this->query[self::TIME] = 'this_month';
		
		return $this;
	}
	
	/**
	 * Returns all feeds 
	 *
	 * @return this
	 */
	public function setToAllTime()
	{
		$this->query[self::TIME] = 'all_time';
		
		return $this;
	}
	
	/**
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @param string
	 * @return array
	 */
	public function search($queryString)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::QUERY]		= $queryString;
		$this->query[self::VERSION]	= self::VERSION_TWO;
		
		return $this->getResponse(self::URL_YOUTUBE_CHANNEL, $this->query);
	}
	
	/**
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @param string
	 * @return array
	 */
	public function getChannelFeeds($feeds)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		//if the input value is not allowed
		if(!in_array($feeds, array('most_viewed', 'most_subscribed'))) {
			//throw error
			Argument::i()
				->setMessage(Argument::INVALID_FEEDS_ONE) 
				->addVariable($feeds)
				->trigger();
		}
			
		$this->query[self::VERSION] = self::VERSION_TWO;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_CHANNEL_FEEDS, $feeds), $this->query);
	}
	
	/**
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getChannelByRegion($regionId, $feeds)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		//if the input value is not allowed
		if(!in_array($feeds, array('most_viewed', 'most_subscribed'))) {
			//throw error
			Argument::i()
				->setMessage(Argument::INVALID_FEEDS_TWO) 
				->addVariable($feeds)
				->trigger();
		}
		
		$this->query[self::VERSION] = self::VERSION_TWO;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_REGION, $regionId, $feeds), $this->query);
	}
}