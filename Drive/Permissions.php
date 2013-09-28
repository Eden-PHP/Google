<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Drive;

use Eden\Google\Base;

/**
 * Google Drive Permissions Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Drive
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Permissions extends Base
{
    const URL_PERMISSIONS_LIST  = 'https://www.googleapis.com/drive/v2/files/%s/permissions';
    const URL_PERMISSIONS_GET   = 'https://www.googleapis.com/drive/v2/files/%s/permissions/%s';

    /* Public Properties
    -------------------------------*/
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
     * Deletes a permission from a file
     *
     * @param string
     * @param string
     * @return array
     */
    public function delete($fileId, $permissionId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 1 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_PERMISSIONS_GET, $fileId, $permissionId));
    }

    /**
     * Lists a file's permissions
     *
     * @param string
     * @return array
     */
    public function getList($fileId)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_PERMISSIONS_LIST, $fileId));
    }

    /**
     * Gets a permission by ID
     *
     * @param string
     * @param string
     * @return array
     */
    public function getSpecific($fileId, $permissionId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_PERMISSIONS_GET, $fileId, $permissionId));
    }

    /**
     * Inserts a permission for a file
     *
     * @param string
     * @param string The primary role for this user
     * @param string The account type
     * @param string The email address or domain name for the entity
     * @return array
     */
    public function insert($fileId, $role, $type, $value = 'me')
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string')
            //argument 4 must be a string
            ->test(4, 'string');

        //if the input value is not allowed
        if (!in_array($role, array('owner', 'reader', 'writer'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_ROLE)
                ->addVariable($role)
                ->trigger();
        }

        //if the input value is not allowed
        if (!in_array($type, array('user', 'group', 'domain', 'anyone'))) {
            //throw error
            Argument::i()
                ->setMessage(Argument::INVALID_TYPE)
                ->addVariable($type)
                ->trigger();
        }

        $this->query[self::VALUE]   = $value;
        $this->query[self::ROLE]    = $role;
        $this->query[self::TYPE]    = $type;

        return $this->post(sprintf(self::URL_PERMISSIONS_LIST, $fileId), $this->query);
    }

    /**
     * Updates a permission. This method supports patch semantics.
     *
     * @param string
     * @param string
     * @return array
     */
    public function patch($fileId, $permissionId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->patch(sprintf(self::URL_PERMISSIONS_GET, $fileId, $permissionId), $this->query);
    }

    /**
     * The name for this permission.
     *
     * @param string
     * @return Eden\Google\Drive\Permission
     */
    public function setName($name)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::NAME] = $name;

        return $this;
    }

    /**
     * The primary role for this user
     * Allowed values are:
     * - owner
     * - reader
     * - writer
     *
     * @param string
     * @return Eden\Google\Drive\Permission
     */
    public function setRole($role)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::ROLE] = $role;

        return $this;
    }

    /**
     * Allowed values are:
     * - user
     * - group
     * - domain
     * - anyone
     *
     * @param string
     * @return Eden\Google\Drive\Permission
     */
    public function setType($type)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::TYPE] = $type;

        return $this;
    }

    /**
     * The email address or domain name for the
     * entity. This is not populated in responses.
     *
     * @param string
     * @return Eden\Google\Drive\Permission
     */
    public function setValue($value)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->query[self::VALUE] = $value;

        return $this;
    }

    /**
     * WWhether the link is required for this permission.
     *
     * @return Eden\Google\Drive\Permission
     */
    public function setWithLink()
    {
        $this->query[self::WITH_LINK] = true;

        return $this;
    }

    /**
     * Updates a permission.
     *
     * @param string
     * @param string
     * @return array
     */
    public function update($fileId, $permissionId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->put(sprintf(self::URL_PERMISSIONS_GET, $fileId, $permissionId), $this->query);
    }
}
