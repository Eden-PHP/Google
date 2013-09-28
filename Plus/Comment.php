<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Plus comment
 *
 * @package Eden
 * @category google
 * @author     Clark Galgo cgalgo@openovate.com
 */
class Plus_Comment extends Base
{
	const URL_COMMENTS_LIST	= 'https://www.googleapis.com/plus/v1/activities/%s/comments';
	const URL_COMMENTS_GET	= 'https://www.googleapis.com/plus/v1/comments/%s';
	
	 
	protected $pageToken	= NULL;
	protected $maxResults	= NULL;
	protected $sortOrder 	= NULL;
	
	public function __construct($token)
	{
		//argument test
		Argument::i()->test(1, 'string');
		$this->token 	= $token;
	}
	
	/**
	 * The continuation token, used to page through large result sets. 
	 * To get the next page of results, set this parameter to the 
	 * value of "nextPageToken" from the previous response. 
	 *
	 * @param string
	 * @return this
	 */
	public function setPageToken($pageToken)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		$this->query[self::PAGE_TOKEN] = $pageToken;
		
		return $this;
	}
	
	/**
	 * The maximum number of people to include in the response, 
	 * used for paging.
	 *
	 * @param integer
	 * @return this
	 */
	public function setMaxResults($maxResults)
	{
		//argument 1 must be a integer
		Argument::i()->test(1, 'int');
		$this->query[self::MAX_RESULTS] = $maxResults;
		
		return $this;
	}
	
	/** 
	 * Sort newest comments first.
	 *
	 * @param string
	 * @return array
	 */
	public function descendingOrder()
	{
		$this->query[self::SORT] = 'descending';
		
		return $this;
	}
	
	/**
	 * List all of the comments for an activity.
	 *
	 * @param string
	 * @return array
	 */
	public function getList($activityId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_COMMENTS_LIST, $activityId), $this->query);
	}
	
	/**
	 * Get a comment
	 *
	 * @param string
	 * @return array
	 */
	public function getSpecific($commentId)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
		
		return $this->getResponse(sprintf(self::URL_COMMENTS_GET, $commentId));
	}
	
}