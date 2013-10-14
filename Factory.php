<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google;

/**
 * Google API factory. This is a factory class with
 * methods that will load up different Google APIs.
 *
 * @vendor Eden
 * @package Google
 * @author Ian Mark Muninio <ianmuninio@openovate.com>
 */
class Factory extends Base
{
    const INSTANCE = 1; // set to singleton

    /**
     * Returns the instance of Auth.
     *
     * @param string $key          the application's key
     * @param string $secret       the application's secret
     * @param string $redirect     the application's redirect uri
     * @return \Eden\Google\Auth
     */
    public function auth($key, $secret, $redirect)
    {
        Argument::i()
                ->test(1, 'string')
                ->test(2, 'string')
                ->test(3, 'url');

        return Auth::i($key, $secret, $redirect);
    }
    
    /**
     * Retunrs the instance of Youtube.
     * 
     * @param string $token
     * @return \Eden\Google\Youtube
     */
    public function youtube($token)
    {
        Argument::i()->test(1, 'string');
        
        return Youtube::i($token);
    }
}
