<?php//-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google;

/**
 *  Google calendar
 *
 * @vendor      Eden
 * @category    Google
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Shortener extends Base
{
    const GOOGLE_SHORTENER_ANALYTICS    = 'https://www.googleapis.com/urlshortener/v1/url';
    const GOOGLE_SHORTENER_GET          = 'https://www.googleapis.com/urlshortener/v1/url/history';
    const GOOGLE_SHORTENER_CREATE       = 'https://www.googleapis.com/urlshortener/v1/url';

    /**
     * Construct - Set's Key and Request Token
     *
     * @param string
     * @param string
     */
    public function __construct($key, $token)
    {
        //Argument test
        Argument::i()
            //Argument 1 must be a string
            ->test(1, 'string')
            //Argument 1 must be a string
            ->test(2, 'string');

        $this->apiKey   = $key;
        $this->token    = $token;
    }

    /**
     * Retrieves a list of URLs shortened by the authenticated user
     *
     * @return array
     */
    public function getList()
    {

        return $this->getResponse(self::GOOGLE_SHORTENER_GET, $this->query);
    }

    /**
     * Returns full analytics of this short url
     *
     * @param string short url
     * @return array
     */
    public function getAnalytics($url)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query['shortUrl'] = $url;

        return $this->getResponse(self::GOOGLE_SHORTENER_ANALYTICS, $this->query);

    }

    /**
     * Creates a new short URL
     *
     * @param string long url
     * @return array
     */
    public function createShortUrl($url)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query['longUrl'] = $url;

        return $this->post(self::GOOGLE_SHORTENER_CREATE, $this->query);

    }

    /**
     * Set start token
     *
     * @param string
     * @return array
     */
    public function setStartToken($startToken)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['start-token'] = $startToken;

        return $this;
    }

    /**
     * Acceptable values are:
     * 'ANALYTICS_CLICKS' - Returns only click counts.
     * 'ANALYTICS_TOP_STRINGS' - Returns only top string counts.
     * 'FULL' - Returns the creation timestamp and all available analytics.
     *
     * @param string
     * @return array
     */
    public function setProjection($projection)
    {
        //Argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query['projection'] = $projection;

        return $this;
    }
}
