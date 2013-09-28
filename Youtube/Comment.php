<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package. 
 */ 

/**
 * Google youtube comments
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Youtube_Comment extends Base
{ 
	const URL_YOUTUBE_GET_COMMENTS	= 'https://gdata.youtube.com/feeds/api/videos/%s/comments';
	const URL_YOUTUBE_COMMENTS		= 'https://gdata.youtube.com/feeds/api/videos/%s/comments/%s';
	
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
	 * Returns a collection of videos that match the API request parameters.
	 *
	 * @param string
	 * @return array
	 */
	public function getList($videoId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_GET_COMMENTS, $videoId));
	}
	
	/**
	 * Returns a specific comment
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getSpecific($videoId, $commentId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		return $this->getResponse(sprintf(self::URL_YOUTUBE_COMMENTS, $videoId, $commentId));
	}
	
	/**
	 * Add comment to a video
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function addComment($videoId, $comment)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
		
		//make a xml template file
		$query = Template::i()
			->set(self::COMMENT, $comment)
			->parsePHP(dirname(__FILE__).'/template/addcomment.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_GET_COMMENTS, $videoId), $query);
	}
		
	/**
	 * Reply to a comment in a video
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return array
	 */
	public function replyToComment($videoId,$commentId, $comment)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string')
			//argument 3 must be a string
			->test(3, 'string');

		//make a xml template file
		$query = Template::i()
			->set(self::COMMENT, $comment)
			->set(self::COMMENT_ID, $commentId)
			->set(self::VIDEO_ID, $videoId)
			->parsePHP(dirname(__FILE__).'/template/replytocomment.php');
		
		return $this->post(sprintf(self::URL_YOUTUBE_GET_COMMENTS, $videoId), $query);
	}
	
	/**
	 * Delete a comment
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function delete($videoId, $commentId)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 2 must be a string
			->test(2, 'string');
	 
		return $this->delete(sprintf(self::URL_YOUTUBE_COMMENTS, $videoId, $commentId));
	}
}