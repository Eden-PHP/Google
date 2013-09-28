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
 * Google Calendar API Factory
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Calendar extends Base
{
    const URL_CALENDAR_COLOR = 'https://www.googleapis.com/calendar/v3/colors';

    /**
     * Construct - Set's the Request Access Token
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
     * Returns Google acl
     *
     * @return Calendar_acl
     */
    public function acl()
    {
        return Calendar_Acl::i($this->token);
    }

    /**
     * Returns Google Calendars
     *
     * @return Calendar_Calendars
     */
    public function calendars()
    {
        return Calendar_Calendars::i($this->token);
    }

    /**
     * Returns the color definitions for
     * calendars and events.
     *
     * @return array
     */
    public function getColors()
    {
        return $this->getResponse(self::URL_CALENDAR_COLOR);
    }

    /**
     * Returns Google Event
     *
     * @return Calendar_Event
     */
    public function event()
    {
        return Calendar_Event::i($this->token);
    }

    /**
     * Returns Google freebusy
     *
     * @return Calendar_freebusy
     */
    public function freebusy()
    {
        return Calendar_Freebusy::i($this->token);
    }

    /**
     * Returns Google List
     *
     * @return Calendar_List
     */
    public function lists()
    {
        return Calendar_List::i($this->token);
    }

    /**
     * Returns Google setting
     *
     * @return Calendar_Settings
     */
    public function settings()
    {
        return Calendar_Settings::i($this->token);
    }
}
