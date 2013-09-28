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
 * Google Calendar Acl Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Calendar
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Acl extends Base
{
    const URL_CALENDAR_ACL_GET      = 'https://www.googleapis.com/calendar/v3/calendars/%s/acl';
    const URL_CALENDAR_ACL_SPECIFIC = 'https://www.googleapis.com/calendar/v3/calendars/%s/acl/%s';

    /**
     * Construct - Set's Request Token
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
     * Creates a secondary calendar.
     *
     * @param string The role assigned to the scope
     * @param string The type of the scope
     * @param string Calendar identifier
     * @return array
     */
    public function create($role, $type, $calendarId = self::PRIMARY)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string');

        $this->query[self::ROLE]    = $role;
        $this->query[self::SCOPE]   = array(self::TYPE => $type);

        return $this->post(sprintf(self::URL_CALENDAR_ACL_GET, $calendarId), $this->query);
    }

    /**
     * Deletes an access control rule
     *
     * @param string ACL rule identifier
     * @param string Calendar identifier
     * @return null
     */
    public function delete($ruleId, $calendarId = self::PRIMARY)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 1 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_CALENDAR_ACL_SPECIFIC, $calendarId, $ruleId));
    }

    /**
     * Returns the rules in the access
     * control list for the calendar.
     *
     * @param string Calendar identifier
     * @return array
     */
    public function getList($calendarId = self::PRIMARY)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_ACL_GET, $calendarId));
    }

    /**
     * Returns an access control rule.
     *
     * @param string ACL rule identifier
     * @param string Calendar identifier
     * @return array
     */
    public function getSpecific($ruleId, $calendarId = self::PRIMARY)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 1 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_CALENDAR_ACL_SPECIFIC, $calendarId, $ruleId));
    }

    /**
     * Set etag
     *
     * @param string ETag of the resource.
     * @return this
     */
    public function setEtag($etag)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::ETAG] = $etag;

        return $this;
    }

    /**
     * Set id
     *
     * @param string|integer Identifier of the ACL rule.
     * @return Eden\Google\Calendar\Acl
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
     * @param string Type of the resource ("calendar#aclRule").
     * @return Eden\Google\Calendar\Acl
     */
    public function setKind($kind)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::KIND] = $kind;

        return $this;
    }

    /**
     * Provides read access to free/busy information.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setRoleToFreeBusyReader()
    {
        $this->query[self::ROLE] = 'freeBusyReader';

        return $this;
    }

    /**
     * Provides no access role.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setRoleToNone()
    {
        $this->query[self::ROLE] = 'none';

        return $this;
    }

    /**
     * Provides read access to the calendar.
     * 1Private events will appear to users
     * with reader access, but event details
     * will be hidden.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setRoleToReader()
    {
        $this->query[self::ROLE] = 'reader';

        return $this;
    }

    /**
     * Provides read and write access to
     * the calendar. Private events will
     * appear to users with writer access,
     * and event details will be visible.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setRoleToWriter()
    {
        $this->query[self::ROLE] = 'writer';

        return $this;
    }

    /**
     * Provides ownership of the calendar.
     * This role has all of the permissions
     * of the writer role with the additional
     * ability to see and manipulate ACLs.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setRoleToOwner()
    {
        $this->query[self::ROLE] = 'owner';

        return $this;
    }

    /**
     * The type of the scope. Possible values are:
     * "default" - The public scope. This is the default value.
     * "user" - Limits the scope to a single user.
     * "group" - Limits the scope to a group.
     * "domain" - Limits the scope to a domain.
     *
     * @return Eden\Google\Calendar\Acl
     */
    public function setType($type)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::TYPE] = $type;

        return $this;
    }

    /**
     * Updates an access control rule
     *
     * @param string ACL rule identifier
     * @param string Calendar identifier
     * @return array
     */
    public function update($ruleId, $calendarId = self::PRIMARY)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 1 must be a string
            ->test(2, 'string');

        return $this->put(sprintf(self::URL_CALENDAR_ACL_SPECIFIC, $calendarId, $ruleId), $this->query);
    }
}
