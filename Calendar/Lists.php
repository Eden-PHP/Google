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
 * Google Calendar List Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Lists extends Base
{
    const URL_CALENDAR_LIST     = 'https://www.googleapis.com/calendar/v3/users/me/calendarList';
    const URL_CALENDAR_GET      = 'https://www.googleapis.com/calendar/v3/users/me/calendarList/%s';

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
     * Adds an entry to the user's calendar list.
     *
     * @param string Identifier of the calendar
     * @return array
     */
    public function create($id)
    {
        //argument test
        Argument::i()->test(1, 'string');

        $this->query[self::ID] = $id;

        return $this->post(self::URL_CALENDAR_LIST, $this->query);
    }

    /**
     * Return all event of calendar
     *
     * @param string Calendar identifier
     * @return array
     */
    public function delete($calendarId)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->delete(sprintf(self::URL_CALENDAR_GET, $calendarId));
    }

    /**
     * Return all event fo calendar
     *
     * @param string Calendar identifier
     * @return array
     */
    public function getCalendar($calendarId)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_GET, $calendarId));
    }

    /**
     * Return all event fo calendar
     *
     * @return array
     */
    public function getList()
    {

        return $this->getResponse(self::URL_CALENDAR_LIST, $this->query);
    }

    /**
     * Updates an entry on the user's calendar list. This method supports patch semantics.
     *
     * @param string Calendar identifier
     * @return array
     */
    public function patch($calendarId)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->patch(sprintf(self::URL_CALENDAR_GET, $calendarId), $this->query);
    }

    /**
     * Set Access Role
     *
     * @param string
     * @return this
     */
    public function setAccessRole($accessRole)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[se::ACCESS_ROLE] = $accessRole;

        return $this;
    }

    /**
     * Set color id
     *
     * @param integer ID referring to an entry in the "calendar" section of the colors definition
     * @return Eden\Google\Calendar\Lists
     */
    public function setColorId($colorId)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::COLOR_ID] = $colorId;

        return $this;
    }

    /**
     * Set default reminders
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setDefaultReminders($defaultReminders)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::DEFAULT_REMINDERS] = $defaultReminders;

        return $this;
    }

    /**
     * Set default reminders
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setDescription($description)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::DESCRIPTION] = $description;

        return $this;
    }

    /**
     * Set etag
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setEtag($etag)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::ETAG] = $etag;

        return $this;
    }

    /**
     * Set calendar hidden
     *
     * @return Eden\Google\Calendar\Lists
     */
    public function setHidden()
    {
        $this->query[self::HIDDEN] = true;

        return $this;
    }

    /**
     * Set id
     *
     * @param string|integer
     * @return Eden\Google\Calendar\Lists
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
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setKind($kind)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::KIND] = $kind;

        return $this;
    }

    /**
     * Set location
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setLocation($location)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::LOCATION] = $location;

        return $this;
    }

    /**
     * Set query max results
     *
     * @param integer
     * @return Eden\Google\Calendar\Lists
     */
    public function setMaxResults($maxResults)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::MAX_RESULTS] = $maxResults;

        return $this;
    }

    /**
     * Set selected
     *
     * @return Eden\Google\Calendar\Lists
     */
    public function setSelected()
    {
        $this->query[self::SELECTED] = true;

        return $this;
    }

    /**
     * Set summary
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setSummary($summary)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::SUMMARY] = $summary;

        return $this;
    }

    /**
     * Set summary override
     *
     * @param string
     * @return Eden\Google\Calendar\Lists
     */
    public function setSummaryOverride($summaryOverride)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::SUMMARY_OVERRIDE] = $summaryOverride;

        return $this;
    }

    /**
     * Set time zone
     *
     * @param string The time zone of the calendar.
     * @return Eden\Google\Calendar\Lists
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
    public function update($calendarId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->put(sprintf(self::URL_CALENDAR_GET, $calendarId), $this->query);
    }
}
