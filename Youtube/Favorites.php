<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */

/**
 * Google youtube favorites
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Favorites extends Base
{ 
	const URL_YOUTUBE_FAVORITES		= 'https://gdata.youtube.com/feeds/api/users/%s/favorites';
	const URL_YOUTUBE_FAVORITES_GET = 'https://gdata.youtube.com/feeds/api/users/%s/favorites/%s';
	
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
	 * Retrieving all user's favorite videos.
	 *
	 * @param string
	 * @return array
	 */
	public function getList($userId = self::DEFAULT_VALUE)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_FAVORITES, $userId), $this->query);
	}
	
	/**
	 * Retrieving specific user's favorite videos.
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getSpecific($favoriteVideoId, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
			
		$this->query[self::RESPONSE] = self::JSON_FORMAT;
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_FAVORITES_GET, $userId, $favoriteVideoId), $this->query);
	}
	
	/**
	 * Retrieving a user's favorite videos.
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function addFavorites($videoId, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
	
		//make a xml template file
		$query = Template::i()
			->set(self::VIDEO_ID, $videoId)
			->parsePHP(dirname(__FILE__).'/template/addfavorites.php');
			
		return $this->post(sprintf(self::URL_YOUTUBE_FAVORITES, $userId), $query);
	}
	
	/**
	 * Retrieving a user's favorite videos.
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function removeFavorites($favoriteVideoId, $userId = self::DEFAULT_VALUE)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->delete(sprintf(self::URL_YOUTUBE_FAVORITES_GET, $userId, $favoriteVideoId));
	}
}