<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google\Youtube;

use Eden\Google\Base;

/**
 * Google youtube search
 *
 * @vendor      Eden
 * @package     Google
 * @category    Youtube
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Search extends Base
{
    const URL_YOUTUBE_SEARCH    = 'https://gdata.youtube.com/feeds/api/videos';

    /* Public Properties
    -------------------------------*/
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
     * @return this
     */
    public function setStart($start)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->query[self::START_INDEX] = $start;

        return $this;
    }

    /**
     * Set start index
     *
     * @param integer
     * @return this
     */
    public function setRange($range)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'integer');
        $this->query[self::MAX_RESULTS] = $range;

        return $this;
    }

    /**
     * Order results by relevance
     *
     * @return this
     */
    public function orderByRelevance()
    {
        $this->query[self::ORDER_BY] = 'relevance';

        return $this;
    }

    /**
     * Order results by published
     *
     * @return this
     */
    public function orderByPublished()
    {
        $this->query[self::ORDER_BY] = 'published';

        return $this;
    }

    /**
     * Order results by viewCount
     *
     * @return this
     */
    public function orderByViewCount()
    {
        $this->query[self::ORDER_BY] = 'viewCount';

        return $this;
    }

    /**
     * Order results by rating
     *
     * @return this
     */
    public function orderByRating()
    {
        $this->query[self::ORDER_BY] = 'rating';

        return $this;
    }

    /**
     * Returns a collection of videos that match the API request parameters.
     *
     * @param string
     * @return array
     */
    public function getResponse($queryString)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query[self::QUERY]       = $queryString;
        $this->query[self::VERSION] = self::VERSION_TWO;

        return $this->getResponse(self::URL_YOUTUBE_SEARCH, $this->queryquery);
    }
}
