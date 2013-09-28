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
 * Google Calendar Calendars Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Calendars extends Base
{
    const URL_CALENDAR_GET      = 'https://www.googleapis.com/calendar/v3/calendars/%s';
    const URL_CALENDAR_CREATE   = 'https://www.googleapis.com/calendar/v3/calendars';
    const URL_CALENDAR_CLEAR    = 'https://www.googleapis.com/calendar/v3/calendars/%s/clear';

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
     * Clears a primary calendar. This operation
     * deletes all data associated with the primary
     * calendar of an account and cannot be undone
     *
     * @param string Calendar identifier
     * @return null
     */
    public function clear($calendarId = self::PRIMARY)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->post(sprintf(self::URL_CALENDAR_CLEAR, $calendarId));
    }

    /**
     * Creates a secondary calendar.
     *
     * @param string* Title of the calendar.
     * @return array
     */
    public function create($summary)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query[self::SUMMARY] = $summary;

        return $this->post(self::URL_CALENDAR_CREATE, $this->query);
    }

    /**
     * Deletes a secondary calendar.
     *
     * @param string Calendar identifier
     * @return null
     */
    public function delete($calendarid = self::PRIMARY)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->delete(sprintf(self::URL_CALENDAR_GET, $calendarId));
    }

    /**
     * Return specific calendar
     *
     * @param string Calendar identifier
     * @return array
     */
    public function getCalendars($calendarId = self::PRIMARY)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_GET, $calendarId));
    }

    /**
     * Updates metadata for a calendar.
     * This method supports patch semantics.
     *
     * @param string Calendar identifier
     * @return array
     */
    public function patch($calendarId = self::PRIMARY)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->patch(sprintf(self::URL_CALENDAR_GET, $calendarId), $this->query);
    }

    /**
     * Set default reminders
     *
     * @param string
     * @return Eden\Google\Calendar\Calendars
     */
    public function setDescription($description)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::DESCRIPTION] = $description;

        return $this;
    }

    /**
     * ETag of the resource.
     *
     * @param string
     * @return Eden\Google\Calendar\Calendars
     */
    public function setEtag($etag)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::ETAG] = $etag;

        return $this;
    }

    /**
     * Identifier of the calendar.
     *
     * @param string|integer
     * @return Eden\Google\Calendar\Calendars
     */
    public function setId($id)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');
        $this->query[self::ID] = $id;

        return $this;
    }

    /**
     * Set calendar kind
     *
     * @param string Type of the resource ("calendar#calendar").
     * @return Eden\Google\Calendar\Calendars
     */
    public function setKind($kind)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::KIND] = $kind;

        return $this;
    }

    /**
     * Set geographic location of the
     * 8 calendar as free-form text.
     *
     * @param string
     * @return Eden\Google\Calendar\Calendars
     */
    public function setLocation($location)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::LOCATION] = $location;

        return $this;
    }

    /**
     * Set summary
     *
     * @param string
     * @return Eden\Google\Calendar\Calendars
     */
    public function setSummary($summary)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::SUMMARY] = $summary;

        return $this;
    }

    /**
     * Set time zone
     *
     * @param string The time zone of the calendar.
     * @return Eden\Google\Calendar\Calendars
     */
    public function setTimeZone($timeZone)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::TIMEZONE] = $timeZone;

        return $this;
    }

    /**
     * Update Calendar
     *
     * @param string Calendar identifier
     * @return array
     */
    public function update($calendarId = self::PRIMARY)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->put(sprintf(self::URL_CALENDAR_GET, $calendarId), $this->query);
    }
}
