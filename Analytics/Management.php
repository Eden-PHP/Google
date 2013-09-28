<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google\Analytics;

use Eden\Google\Base;

/**
 * Google
 *
 * @vendor      Eden
 * @package     Google
 * @category    Analytics
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Management extends Base
{
    const URL_ANALYTICS_ACCOUNTS        = 'https://www.googleapis.com/analytics/v3/management/accounts';
    const URL_ANALYTICS_WEBPROPERTIES   = 'https://www.googleapis.com/analytics/v3/management/accounts/%s/webproperties';
    const URL_ANALYTICS_PROFILE         = 'https://www.googleapis.com/analytics/v3/management/accounts/%s/webproperties/%s/profiles';
    const URL_ANALYTICS_GOALS           = 'https://www.googleapis.com/analytics/v3/management/accounts/%s/webproperties/%s/profiles/%s/goals';
    const URL_ANALYTICS_SEGMENTS        = 'https://www.googleapis.com/analytics/v3/management/segments';

    /* Public Properties
    -------------------------------*/
    protected $startIndex       = null;
    protected $maxResults       = null;

    /**
     * Construct - Set's Request Token
     *
     * @param string
     */
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
     * @return Eden\Google\Analytics\Management
     */
    public function setStartIndex($startIndex)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->startIndex = $startIndex;

        return $this;
    }

    /**
     * Set start index
     *
     * @param integer
     * @return Eden\Google\Analytics\Management
     */
    public function setMaxResults($maxResults)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->maxResults = $maxResults;

        return $this;
    }

    /**
     * Returns all accounts to which the user has access.
     *
     * @return array
     */
    public function getAccounts()
    {
        //populate parameters
        $query = array(
            self::START_INDEX   => $this->startIndex,       //optional
            self::MAX_RESULTS   => $this->maxResults);      //optional

        return $this->getResponse(self::URL_ANALYTICS_ACCOUNTS, $query);
    }

    /**
     * Returns web properties to which the user has access
     *
     * @param string
     * @return array
     */
    public function getWebProperties($accountId = self::ALL)
    {
        //argument test
        Argument::i()->test(1, 'string');

        //populate parameters
        $query = array(
            self::START_INDEX   => $this->startIndex,       //optional
            self::MAX_RESULTS   => $this->maxResults);      //optional

        return $this->getResponse(sprintf(self::URL_ANALYTICS_WEBPROPERTIES, $accountId), $query);
    }

    /**
     * Returns lists of profiles to which the user has access
     *
     * @param string
     * @param string
     * @return array
     */
    public function getProfiles($accountId = self::ALL, $webPropertyId = self::ALL)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        //populate parameters
        $query = array(
            self::START_INDEX   => $this->startIndex,       //optional
            self::MAX_RESULTS   => $this->maxResults);      //optional

        return $this->getResponse(sprintf(self::URL_ANALYTICS_PROFILE, $accountId, $webPropertyId), $query);
    }

    /**
     * Returns lists of goals to which the user has access
     *
     * @param string
     * @param string
     * @param string
     * @return array
     */
    public function getGoals($accountId = self::ALL, $webPropertyId = self::ALL, $profileId = self::ALL)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string');

        //populate parameters
        $query = array(
            self::START_INDEX   => $this->startIndex,       //optional
            self::MAX_RESULTS   => $this->maxResults);      //optional

        return $this->getResponse(sprintf(self::URL_ANALYTICS_GOALS, $accountId, $webPropertyId, $profileId), $query);
    }

    /**
     * Returns lists of advanced segments to which the user has access
     *
     * @return array
     */
    public function getSegments()
    {
        //populate parameters
        $query = array(
            self::START_INDEX   => $this->startIndex,       ///optional
            self::MAX_RESULTS   => $this->maxResults);      //optional

        return $this->getResponse(self::URL_ANALYTICS_SEGMENTS, $query);
    }
}
