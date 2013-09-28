<?php//-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google;

use Eden\Core\Exception as CoreException;

/**
 * Google Errors
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Exception extends CoreException
{
    const INVALID_ROLE			= 'Argument 2 was expecting owner, reader, writer. %s was given';
    const INVALID_TYPE			= 'Argument 3 was expecting user, group, domain, anyone. %s was given';
    const INVALID_COLLECTION	= 'Argument 2 was expecting plusoners, resharers. %s was given';
    const INVALID_FEEDS_TWO		= 'Argument 2 was expecting most_viewed, most_subscribed. %s was given';
    const INVALID_FEEDS_ONE		= 'Argument 1 was expecting most_viewed, most_subscribed. %s was given';
    const INVALID_STATUS		= 'Argument 2 was expecting accepted, rejected. %s was given';

    /**
     * Invoke the error class.
     *
     * @param string|null
     * @param int
     * @return Eden\Google\Exception
     */
    public static function i($message = null, $code = 0)
    {
        $class = __CLASS__;
        return new $class($message, $code);
    }
}
