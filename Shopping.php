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
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Shopping extends Base
{
    const RANGES            = ':ranges';
    const REQUEST_URL       = 'https://www.googleapis.com/shopping/search/v1/public/products';

    const NAME              = 'name';
    const VALUE             = 'value';

    const QUERY             = 'q';
    const COUNTRY           = 'country';
    const CURRENCY          = 'currency';
    const RESTRICT_BY       = 'restrictBy';
    const RANK_BY           = 'rankBy';
    const CROWD_BY          = 'crowdBy';
    const SPELLING_CHECK    = 'spelling.enabled';
    const FACETS_ENABLED    = 'facets.enabled';
    const FACETS_INCLUDE    = 'facets.include';
    protected $country      = null;
    protected $currency     = null;
    protected $restrictBy   = array();
    protected $rankBy       = array();
    protected $crowding     = array();
    protected $keyword      = array();
    protected $spellChecker = false;
    protected $facet        = false;

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
     *  Add facet
     *
     * @param string
     * @param array
     * @return Eden\Google\Shopping
     */
    public function addFacet($name, $value, $range = false)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string', 'int')
            ->test(3, 'bool');

        if (!$this->facet) { //set facet if not yet set
            $this->facet = true;
        }

        if ($range) {
            $value = $value.self::RANGES;
        }

        $this->facetItem[] = array(
            self::NAME      => $name,
            self::VALUE     => $value);

        return $this;

    }

    /**
     *  add keyword to be searched
     *
     * @param string
     * @return Eden\Google\Shopping
     */
    public function addKeyword($keyword)
    {
        Argument::i()->test(1, 'string');
        $this->keyword[] = $keyword;

        return $this;
    }

    /**
     *  Add restriction for the search
     *
     * @param string
     * @param array
     * @return Eden\Google\Shopping
     */
    public function addRestriction($name, $value)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'array');

        $this->restrictBy[] = array(
            self::NAME  => $name,
            self::VALUE => implode('|', $value));

        return $this;
    }

    /**
     * get response
     *
     * @return json
     */
    public function getResponse()
    {
        if (!empty($this->restrictBy)) {
            foreach ($this->restrictBy as $key => $restrict) {
                $restrictBy[] = $restrict[self::NAME].':'.$restrict[self::VALUE];
            }
        }

        if (!empty($this->rankBy)) {
            $order = $this->rankBy[self::NAME].':'.$this->rankBy[self::VALUE];
        }

        if (!empty($this->crowding)) {
            $crowding = $this->crowding[self::NAME].':'.$this->crowding[self::VALUE];
        }

        if (!empty($this->facetItem)) {
            foreach ($this->facetItem as $key => $facet) {
                $facets[] = $facet[self::NAME].':'.$facet[self::VALUE];
            }
        }

        $params = array(
            self::QUERY             => implode('|', $this->keyword),
            self::COUNTRY           => $this->country,
            self::CURRENCY          => $this->currency,
            self::RESTRICT_BY       => (!isset($restrictBy)) ? null : implode(', ', $restrictBy),
            self::RANK_BY           => (!isset($order)) ? null : $order,
            self::CROWD_BY          => (!isset($crowding)) ? null : $crowding,
            self::SPELLING_CHECK    => ($this->spellChecker) ? 'true' : 'false',
            self::FACETS_ENABLED    => ($this->facet) ? 'true' : 'false',
            self::FACETS_INCLUDE    => (!isset($facets)) ? null : implode(', ', $facets));

        return $this->getResponse(self::REQUEST_URL, $params);
    }

    /**
     *  Sets the country
     *
     * @param string
     * @return Eden\Google\Shopping
     */
    public function setCountry($country = 'US')
    {
        Argument::i()->test(1, 'string');
        $this->country = $country;

        return $this;
    }

    /**
     * Set crowding of the search result
     *
     * @param string
     * @param int
     * @return Eden\Google\Shopping
     */
    public function setCrowding($name, $occurrence)
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'int');

        $this->crowding = array(
            self::NAME  => $name,
            self::VALUE => $occurrence);

        return $this;
    }

    /**
     *  Sets currency
     *
     * @param string
     * @return Eden\Google\Shopping
     */
    public function setCurrency($currency = 'USD')
    {
        Argument::i()->test(1, 'string');
        $this->currency = $currency;

        return $this;
    }

    /**
     * Set facet
     *
     * @param bool
     * @return Eden\Google\Shopping
     */
    public function setFacet($value = true)
    {
        Argument::i()->test(1, 'bool');
        $this->facet = $value;

        return $this;
    }

    /**
     * Set Order of the search result
     *
     * @param string
     * @param array
     * @return Eden\Google\Shopping
     */
    public function setOrder($name, $value = 'assending')
    {
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string');

        $this->rankBy = array(
            self::NAME  => $name,
            self::VALUE => $value);

        return $this;
    }

    /**
     * Set spell checker
     *
     * @param bool
     * @return Eden\Shopping\Google
     */
    public function setSpellChecker($value = true)
    {
        Argument::i()->test(1, 'bool');
        $this->spellChecker = $value;

        return $this;
    }
}
