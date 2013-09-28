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
 * Google Calendar Event Class
 *
 * @vendor      Eden
 * @package     Event
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Event extends Base
{
    const URL_CALENDAR_EVENT        = 'https://www.googleapis.com/calendar/v3/calendars/%s/events';
    const URL_CALENDAR              = 'https://www.googleapis.com/calendar/v3/calendars/%s/events/%s';
    const URL_CALENDAR_IMPORT       = 'https://www.googleapis.com/calendar/v3/calendars/%s/events/import';
    const URL_CALENDAR_MOVE         = 'https://www.googleapis.com/calendar/v3/calendars/%s/events/%s/move';
    const URL_QUICK_CREATE_EVENT    = 'https://www.googleapis.com/calendar/v3/calendars/%s/events/quickAdd';
    const URL_CALENDAR_INSTANCES    = 'https://www.googleapis.com/calendar/v3/calendars/%s/events/%s/instances';

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
     * sets the attendees for event
     *
     * @param string|array
     * @return this
     */
    public function addAttendee($attendee)
    {
        //argument 1 must be a string or array
        Argument::i()->test(1, 'string', 'array');

        if (!is_array($attendee)) {
            $attendee = array($attendee);
        }

        foreach ($attendee as $user) {
            $this->query[self::ATTENDESS][] = array('email' => $user);
        }

        return $this;
    }

    /**
     * Create event
     *
     * @param string* Title of the calendar
     * @param string* Calendar identifier.
     * @return array
     */
    public function create($summary, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        $this->query[self::SUMMARY] = $summary;

        return $this->post(sprintf(self::URL_CALENDAR_EVENT, $calendarId), $this->query);
    }

    /**
     * Delete Calendar specific events
     *
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function delete($eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_CALENDAR, $calendarId, $eventId));
    }

    /**
     * Return all event fo calendar
     *
     * @param string Calendar identifier
     * @return array
     */
    public function getEvent($calendarId = self::PRIMARY)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'int', 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_EVENT, $calendarId));
    }

    /**
     * Return instances of specific event
     *
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function getInstances($eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_INSTANCES, $calendarId, $eventId));
    }

    /**
     * Return specific event
     *
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function getSpecificEvent($eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR, $calendarId, $eventId));
    }

    /**
     * Import an event of a calendar
     *
     * @param  string|integer The (exclusive) start time of the event
     * @param  string|integer The (exclusive) end time of the event
     * @param  string Event ID in the iCalendar format.
     * @param  string Calendar identifier
     * @return array
     */
    public function importEvent($start, $end, $importId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            ->test(1, 'string', 'int')  //argument 1 must be a string or integer
            ->test(2, 'string', 'int')  //argument 2 must be a string or integer
            //argument 3 must be a string
            ->test(3, 'string')
            //argument 4 must be a string
            ->test(4, 'string');

        if (is_string($start)) {
            $start = strtotime($start);
        }

        if (is_string($end)) {
            $end = strtotime($end);
        }

        $end['dateTime']    = date('c', $end);
        $start['dateTime']  = date('c', $start);

        $this->query[self::START]   = $start['dateTime'] = date('c', $start);
        $this->query[self::END]     = $end['dateTime'] = date('c', $end);
        $this->query[self::UID]     = $importId;

        return $this->post(sprintf(self::URL_CALENDAR_IMPORT, $calendarId), $this->query);
    }

    /**
     * Moves an event to another calendar
     *
     * @param string Calendar identifier of the target calendar where the event is to be moved to.
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function moveEvent($destination, $eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string');

        $this->query[self::DESTINATION] = $description;

        return $this->customPost(sprintf(self::URL_CALENDAR_MOVE, $calendarId, $eventId), $this->query);
    }

    /**
     * Updates an entry on the user's calendar list.
     * This method supports patch semantics.
     *
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function patch($eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->patch(sprintf(self::URL_CALENDAR, $calendarId, $eventId), $this->query);
    }

    /**
     * Creates an event based on a simple text string
     *
     * @param string The text describing the event to be created.
     * @param string Calendar identifier
     * @return array
     */
    public function quickCreate($text, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        $this->query[self::TEXT] = $text;

        return $this->customPost(sprintf(self::URL_QUICK_CREATE_EVENT, $calendarId), $this->query);
    }

    /**
     * Set event color id
     *
     * @param integer
     * @return this
     */
    public function setColorId($colorId)
    {
        //argument 1 must be a integer
        Argument::i()->test(1, 'int');
        $this->query[self::COLOR_ID] = $colorId;

        return $this;
    }

    /**
     * Set the color of the event.
     *
     * @param string ID referring to an entry in the "event" section of the colors definition
     * @return this
     */
    public function setCreator($creator)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::CREATOR] = $creator;

        return $this;
    }

    /**
     * Set event description
     *
     * @param string
     * @return this
     */
    public function setDescription($description)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::DESCRIPTION] = $description;

        return $this;
    }

    /**
     * sets the end for event
     *
     * @param string|int
     * @return this
     */
    public function setEnd($end)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');

        if (is_string($end)) {
            $end = strtotime($end);
        }

        $this->query[self::END]['dateTime'] = date('c', $end);

        return $this;
    }

    /**
     * Set event kind
     *
     * @param string
     * @return this
     */
    public function setKind($kind)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::KIND] = $kind;

        return $this;
    }

    /**
     * Set the location for event
     *
     * @param string
     * @return this
     */
    public function setLocation($location)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::LOCATION] = $location;

        return $this;
    }

    /**
     * Set event organizer
     *
     * @param string
     * @return this
     */
    public function setOrganizer($organizer)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::ORGANIZER] = $organizer;

        return $this;
    }

    /**
     * Set event reminders
     *
     * @param string
     * @return this
     */
    public function setReminders($reminders)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::REMINDERS] = $reminders;

        return $this;
    }
    /**
     * Set start for event
     *
     * @param string|int
     * @return this
     */
    public function setStart($start)
    {
        //argument 1 must be a string or integer
        Argument::i()->test(1, 'string', 'int');

        if (is_string($start)) {
            $start = strtotime($start);
        }

        $this->query[self::START]['dateTime'] = date('c', $start);

        return $this;
    }

    /**
     * Set event status
     *
     * @param string
     * @return this
     */
    public function setStatus($status)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::STATUS] = $status;

        return $this;
    }

    /**
     * Update Calendar specific events
     *
     * @param string Event identifier
     * @param string Calendar identifier
     * @return array
     */
    public function update($eventId, $calendarId = self::PRIMARY)
    {
        //argument testing
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->put(sprintf(self::URL_CALENDAR, $calendarId, $eventId), $this->query);
    }
}
