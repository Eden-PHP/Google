<?php //--> 
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */

/**
 * Google Youtube ratings
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Ratings extends Base
{ 
	const URL_YOUTUBE_RATINGS	= 'https://gdata.youtube.com/feeds/api/videos/%s/ratings';	/* Public Properties 
	-------------------------------*/
	public function __construct($token, $developerId)
	{
		//argument test
		Argument::i()
			->test(1, 'string')
			->test(2, 'string');
			
		$this->token	 	= $token;
		$this->developerId = $developerId;
	}
	
	/**
	 * Add a numeric (1-5) video rating
	 *
	 * @param string
	 * @param integer Video ratings (1-5)
	 * @return array
	 */
	public function addRating($videoId, $rating)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			->test(2, 'string', 'int');	//argument 2 must be a string or integer
	
		//make a xml template
		$query = Template::i()
			->set(self::RATINGS, $rating)
			->parsePHP(dirname(__FILE__).'/template/addratings.php');
			
		return $this->post(sprintf(self::URL_YOUTUBE_RATINGS, $videoId), $query);
	}
	
	/**
	 * Like a video
	 *
	 * @param string
	 * @return array
	 */
	public function like($videoId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
	
		//make a xml template
		$query = Template::i()
			->set(self::VALUE, self::LIKE)
			->parsePHP(dirname(__FILE__).'/template/like.php');
			
		return $this->post(sprintf(self::URL_YOUTUBE_RATINGS, $videoId), $query);
	}
	
	/**
	 * Dislike a video
	 *
	 * @param string
	 * @return array
	 */
	public function dislike($videoId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		//make a xml template
		$query = Template::i()
			->set(self::VALUE, self::DISLIKE)
			->parsePHP(dirname(__FILE__).'/template/like.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_RATINGS, $videoId), $query);
	}
}