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
 * Google Maps
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Maps extends Base
{
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
     * Returns Google maps direction
     *
     * @return Maps_Direction
     */
    public function direction()
    {

        return Maps_Direction::i($this->token);
    }

    /**
     * Returns Google maps distance
     *
     * @return Maps_Distance
     */
    public function distance()
    {

        return Maps_Distance::i($this->token);
    }

    /**
     * Returns Google maps elevation
     *
     * @return Maps_Elevation
     */
    public function elevation()
    {

        return Maps_Elevation::i($this->token);
    }

    /**
     * Returns Google maps geocoding
     *
     * @return Maps_Geocoding
     */
    public function geocoding()
    {

        return Maps_Geocoding::i($this->token);
    }

    /**
     * Returns Google maps image
     *
     * @return Maps_Image
     */
    public function image()
    {

        return Maps_Image::i($this->token);
    }
}
