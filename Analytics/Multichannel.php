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
 * Google analytics multi channel funnel
 *
 * @vendor      Eden
 * @package     Google
 * @category    Analytics
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Multichannel extends Base
{
    const URL_ANALYTICS_MULTI_CHANNEL = 'https://www.googleapis.com/analytics/v3/data/mcf';

    /* Public Properties
    -------------------------------*/
    protected $startIndex   = null;
    protected $maxResults   = null;
    protected $dimensions   = null;
    protected $sort         = null;
    protected $filters      = null;

    /**
     * Construct - Set's the Request Token
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
     * @return Eden\Google\Analytics\Multichannel
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
     * @return Eden\Google\Analytics\Multichannel
     */
    public function setMaxResults($maxResults)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->maxResults = $maxResults;

        return $this;
    }

    /**
     * Set dimensions
     *
     * @param integer
     * @return Eden\Google\Analytics\Multichannel
     */
    public function setDimesion($dimensions)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Set sort
     *
     * @param integer
     * @return Eden\Google\Analytics\Multichannel
     */
    public function setSort($sort)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->sort = $sort;

        return $this;
    }

    /**
     * Dimension or metric filters that restrict the data returned for your request.
     *
     * @param integer
     * @return Eden\Google\Analytics\Multichannel
     */
    public function setFilters($filters)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->filters = $filters;

        return $this;
    }

    /**
     * Returns all accounts to which the user has access.
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @return array
     */
    public function getInfo($id, $startDate, $endDate, $metrics)
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
            'ids'           => $id,
            'start-date'    => $startDate,
            'end-date'      => $endDate,
            'metrics'       => $metrics,
            'dimensions'    => $this->dimensions,       //optional
            'sort'          => $this->sort,         //optional
            'filters'       => $this->filters,          //optional
            'start-index'   => $this->startIndex,       //optional
            'max-results'   => $this->maxResults);      //optional

        return $this->getResponse(self::URL_ANALYTICS_MULTI_CHANNEL, $query);
    }
}
