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
 * Google Calendar Freebusy Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Freebusy extends Base
{
    const URL_CALENDAR_FREEBUSY = 'https://www.googleapis.com/calendar/v3/freeBusy';

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
     * Returns free/busy information
     * for a set of calendars
     *
     * @param string|integer The start of the interval
     * @param string|integer The end of the interval
     * @return array
     */
    public function query($startTime, $endTime)
    {
        //argument test
        Argument::i()
            ->test(1, 'string', 'int')      //argument 1 must be a string or integer
            ->test(2, 'string', 'int');     //argument 2 must be a string or integer

        if (is_string($startTime)) {
            $startTime = strtotime($startTime);
        }

        if (is_string($endTime)) {
            $endTime = strtotime($endTime);
        }

        $this->query[self::TIMEMIN] = $startTime;
        $this->query[self::TIMEMAX] = $endTime;

        return $this->post(self::URL_CALENDAR_FREEBUSY, $this->query);
    }

    /**
     * Set calendar expansion max
     *
     * @param intger
     * @return Eden\Google\Calendar\Freebusy
     */
    public function setCalendarExpansionMax($calendarExpansionMax)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::CALENDAR_EXPANSION] = $calendarExpansionMax;

        return $this;
    }

    /**
     * Set group expansion max
     *
     * @param intger
     * @return Eden\Google\Calendar\Freebusy
     */
    public function setGroupExpansionMax($groupExpansionMax)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::GROUP_EXPANSION] = $groupExpansionMax;

        return $this;
    }

    /**
     * Set items
     *
     * @param string|intger
     * @return Eden\Google\Calendar\Freebusy
     */
    public function setItem($item)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');
        $this->query[self::ITEMS] = array(self::ID => $item);

        return $this;
    }
}
