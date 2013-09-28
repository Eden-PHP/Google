<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Calendar;

use Eden\Google\Base;

/**
 * Google Calendar Settings Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Settings extends Base
{
    const URL_CALENDAR_SETTINGS     = 'https://www.googleapis.com/calendar/v3/users/me/settings';
    const URL_CALENDAR_SETTINGS_GET = 'https://www.googleapis.com/calendar/v3/users/me/settings/%s';

    /**
     * Construct - Set's the Request Token
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
     * Returns all user settings for the authenticated user.
     *
     * @return array
     */
    public function getList()
    {
        return $this->getResponse(self::URL_CALENDAR_SETTINGS);
    }

    /**
     * Returns a single user setting
     *
     * @param string Name of the user setting.
     * @return array
     */
    public function getSpecific($setting)
    {
        return $this->getResponse(sprintf(self::URL_CALENDAR_SETTINGS_GET, $setting));
    }
}
