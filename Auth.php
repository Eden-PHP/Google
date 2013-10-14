<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google;

use Eden\Oauth\Oauth2\Client;

/**
 * Google Authentication
 *
 * @vendor Eden
 * @package Google
 * @author Ian Mark Muninio <ianmuninio@openovate.com>
 */
class Auth extends Client
{
    const REQUEST_URL = 'https://accounts.google.com/o/oauth2/auth';
    const ACCESS_URL = 'https://accounts.google.com/o/oauth2/token';
    const USER_AGENT = 'google-api-eden-php-3.1';

    /**
     * Sets the application's key, secret and redirect uri.
     *
     * @param string $clientId     the application's key
     * @param string $clientSecret the application's secret
     * @param string $redirectUri  the application's redirect uri
     * @return void
     */
    public function __construct($clientId, $clientSecret, $redirectUri)
    {
        Argument::i()
                ->test(1, 'string')
                ->test(2, 'string')
                ->test(3, 'url');

        parent::__construct($clientId, $clientSecret, $redirectUri, self::REQUEST_URL, self::ACCESS_URL);
    }
}
