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
 * Google Analytics
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Analytics extends Base
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
     * Returns Google analytics management
     *
     * @return Analytics_Management
     */
    public function management()
    {
        return Analytics_Management::i($this->token);
    }

    /**
     * Returns Google analytics reporting
     *
     * @return Analytics_Reporting
     */
    public function reporting()
    {
        return Analytics_Reporting::i($this->token);
    }

    /**
     * Returns Google analytics multichannel
     *
     * @return Analytics_Multichannel
     */
    public function multiChannel()
    {
        return Analytics_Multichannel::i($this->token);
    }
}
