<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */

/**
 * Google youtube video
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Video extends Base
{ 
	const URL_YOUTUBE_FEEDS		= 'https://gdata.youtube.com/feeds/api/standardfeeds/%s';
	const URL_YOUTUBE_CATEGORY	= 'https://gdata.youtube.com/feeds/api/videos';
	const URL_YOUTUBE_REGION	= 'http://gdata.youtube.com/feeds/api/standardfeeds/%s/%s';
	const URL_YOUTUBE_FAVORITES	= 'http://gdata.youtube.com/feeds/api/users/%s/favorites';
	const URL_YOUTUBE_GET		= 'https://gdata.youtube.com/feeds/api/videos/%s';
	
	/* Public Properties 
	-------------------------------*/
	protected $feeds 		= 'most_popular';
	
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token = $token; 
	}

	/**
	 * Returns the most highly rated YouTube videos.
	 *
	 * @return this
	 */
	public function filterByTopRated()
	{
		$this->feeds = 'top_rated';
		
		return $this;
	}
	
	/**
	 * Returns videos most frequently flagged as favorite videos.
	 *
	 * @return this
	 */
	public function filterByTopFavorites()
	{
		$this->feeds = 'top_favorites';
		
		return $this;
	}
	
	/**
	 * Returns YouTube videos most frequently shared on Facebook and Twitter.
	 *
	 * @return this
	 */
	public function filterByMostShared()
	{
		$this->feeds = 'most_shared';
		return $this;
	}
	
	/**
	 * Returns the most popular YouTube videos, 
	 *
	 * @return this
	 */
	public function filterByMostPopular()
	{
		$this->feeds = 'most_popular';
		return $this;
	}
	
	/**
	 * Returns videos most recently submitted to YouTube.
	 *
	 * @return this
	 */
	public function filterByMostRecent()
	{
		$this->feeds = 'most_recent';
		return $this;
	}
		
	/**
	 * Returns YouTube videos that have received the most comments.
	 *
	 * @return this
	 */
	public function filterByMostDiscussed()
	{
		$this->feeds = 'most_discussed';
		return $this;
	}
	
	/**
	 * Returns YouTube videos that receive the most video responses.
	 *
	 * @return this
	 */
	public function filterByMostResponded()
	{
		$this->feeds = 'most_responded';
		return $this;
	}
	
	/**
	 * Returns videos recently featured on the YouTube home page or featured videos tab.
	 *
	 * @return this
	 */
	public function filterByRecentFeatured()
	{
		$this->feeds = 'recently_featured';
		return $this;
	}
	
	/**
	 * Returns lists trending videos as seen on YouTube Trends,
	 *
	 * @return this
	 */
	public function filterByOnTheWeb()
	{
		$this->feeds = 'on_the_web';
		return $this;
	}
	
	/**
	 * Returns a specific videos
	 *
	 * @param string
	 * @return array
	 */
	public function getSpecific($videoId)
	{
		//argument test
		Argument::i()->test(1, 'string');
	
		return $this->getResponse(sprintf(self::URL_YOUTUBE_GET, $videoId));
	}
	
	/**
	 * Returns a collection of videos of users favorites.
	 *
	 * @return array
	 */
	public function getFavorites()
	{
		$this->query[self::VERSION] = self::VERSION_TWO;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_FAVORITES, $this->feeds), $this->query);
	}
	
	/**
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @return array
	 */
	public function getList()
	{
		return $this->getResponse(sprintf(self::URL_YOUTUBE_FEEDS, $this->feeds));
	}
	
	/**
	 * Returns a collection of videos from category.
	 *
	 * @param string
	 * @return array
	 */
	public function getListByCategory($category)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		$this->query[self::CATEGORY]	= $category;
		$this->query[self::VERSION]	= self::VERSION_TWO;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_CATEGORY, $this->feeds), $this->query);
	}
	
	/**
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @param string
	 * @return array
	 */
	public function getListByRegion($regionId)
	{
		//argument test
		Argument::i()->test(1, 'string');
		
		//populate parameters
		$query = array(self::VERSION => self::VERSION_TWO);
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_REGION, $regionId, $this->feeds), $query);
	}
}