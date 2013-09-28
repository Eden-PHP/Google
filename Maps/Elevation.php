<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Maps;

use Eden\Google\Base;

/**
 * Google Map Static Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Maps
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Elevation extends Base
{
    const URL_MAP_ELEVATION = 'http://maps.googleapis.com/maps/api/elevation/json';

    /* Public Properties
    -------------------------------*/
    /**
     * Defines a path on the earth for which to return elevation data.
     *
     * @param string|int|float
     * @param string|int|float
     * @return Eden\Google\Maps\Elevation
     */
    public function setPath($latitude, $longtitude)
    {
        //argument testing
        Argument::i()
            ->test(1, 'string', 'int', 'float')     //argument 1 must be a string, integer or float
            ->test(2, 'string', 'int', 'float');    //argument 2 must be a string, integer or float

        $this->query['path'] = $latitude.', '.$longtitude;

        return $this;
    }

    /**
     * Specifies the number of sample points along a
     * path for which to return elevation data.
     *
     * @param string|integer
     * @return Eden\Google\Maps\Elevation
     */
    public function setSamples($samples)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');

        $this->query['samples'] = $samples;

        return $this;
    }

    /**
     * Returns elevation information
     *
     * @param string latitude,longitude pair in string(e.g. "40.714728,-73.998672")
     * @return array
     */
    public function getResponse($location, $sensor = 'false')
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        $this->query['locations']   = $location;
        $this->query['sensor']      = $sensor;

        return $this->getResponse(self::URL_MAP_ELEVATION, $this->query);
    }
}
