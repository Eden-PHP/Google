<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

/**
 * Google Plus people
 *
 * @package Eden
 * @category google
 * @author     Clark Galgo cgalgo@openovate.com
 */
class Plus_People extends Base
{
	const URL_GET_USER			= 'https://www.googleapis.com/plus/v1/people/%s';
	const URL_PEOPLE_SEARCH		= 'https://www.googleapis.com/plus/v1/people';
	const URL_PEOPLE_ACTIVITY	= 'https://www.googleapis.com/plus/v1/activities/%s/people/%s';
	
	 
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
	 * Returns user info
	 *
	 * @param string
	 * @return array
	 */
	public function getUserInfo($userId = self::ME)
	{
		//argument 1 must be a string
		Argument::i()->test(1, 'string');
			
		return $this->getResponse(sprintf(self::URL_GET_USER,$userId));
	}
	
	/**
	 * Returns people that matches the queryString
	 *
	 * @param string|integer Full text search of public text in all profiles.
	 * @return array
	 */
	public function search($queryString)
	{
		//argument 1 must be a string or integer
		Argument::i()->test(1, 'string', 'int');
		
		$this->query[self::QUERY_STRING] = $queryString;
		
		return $this->getResponse(self::URL_PEOPLE_SEARCH, $this->query);
	}
	
	/**
	 * List all of the people in the specified 
	 * collection for a particular activity
	 *
	 * @param string
	 * @param string
	 * @return array
	 */
	public function getActivityList($activityId, $collection)
	{
		//argument test
		Argument::i()
			//argument 1 must be a string
			->test(1, 'string')
			//argument 1 must be a string
			->test(2, 'string');
			
		//if the input value is not allowed
		if(!in_array($collection, array('plusoners', 'resharers'))) {
			//throw error
			Argument::i()
				->setMessage(Argument::INVALID_COLLECTION) 
				->addVariable($collection)
				->trigger();
		}
		
		$this->query[self::ACTIVITY_ID]	= $activityId;
		$this->query[self::COLLECTION]		= $collection;
		
		return $this->getResponse(sprintf(self::URL_PEOPLE_ACTIVITY, $activityId, $collection), $this->query);
	}	
}