<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google;

use Eden\Google\Youtube\Model;

/**
 * Endpoint factory. This is a factory class with
 * methods that will load up different Youtube API endpoints.
 *
 * @vendor Eden
 * @package Google
 * @author Ian Mark Muninio <ianmuninio@openovate.com>
 */
class Youtube extends Base
{
    /**
     * Preloads the access token.
     *
     * @param string $token access token
     * @return void
     */
    public function __construct($token)
    {
        Argument::i()->test(1, 'string');
        
        $this->token = $token;
    }
}
