<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Plus;

use Eden\Google\Base;

/**
 * Google Plus activity
 *
 * @vendor      Eden
 * @package     Google
 * @category    Plus
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Activity extends Base
{
    const URL_ACTIVITY_LIST     = 'https://www.googleapis.com/plus/v1/people/%s/activities/%s';
    const URL_ACTIVITY_GET      = 'https://www.googleapis.com/plus/v1/activities/%s';
    const URL_ACTIVITY_SEARCH   = 'https://www.googleapis.com/plus/v1/activities';


    protected $pageToken        = null;
    protected $maxResults       = null;
    protected $orderBy          = null;

    /**
     * Construct - Set's Request Token
     *
     * @param string
     */
    public function __construct($token)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->token    = $token;
    }

    /**
     * Set page token
     *
     * @param string
     * @return array
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
     * @return Eden\Google\Plus\Activity
     */
    public function setMaxResults($maxResults)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::MAX_RESULTS] = $maxResults;

        return $this;
    }

    /**
     * Sort activities by relevance to the user, most relevant first.
     *
     * @return Eden\Google\Plus\Activity
     */
    public function orderByBest()
    {
        $this->query[self::ORDER] = 'best';

        return $this;
    }

    /**
     * Sort activities by published date, most recent first.
     *
     * @return Eden\Google\Plus\Activity
     */
    public function orderByRecent()
    {
        $this->query[self::ORDER] = 'recent';

        return $this;
    }

    /**
     * Get activity list of user
     *
     * @param string
     * @return array
     */
    public function getList($userId = self::ME)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_ACTIVITY_LIST, $userId, self::PUBLIC_DATA), $this->query);
    }

    /**
     * Get an activity
     *
     * @param string
     * @return array
     */
    public function getSpecific($activityId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

         return $this->getResponse(sprintf(self::URL_ACTIVITY_GET, $activityId));
    }

    /**
     * Search public activities
     *
     * @param string|integer
     * @return array
     */
    public function search($queryString)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string', 'int');

        $this->query[self::QUERY_STRING] = $queryString;

        return $this->getResponse(self::URL_ACTIVITY_SEARCH, $this->query);
    }
}
