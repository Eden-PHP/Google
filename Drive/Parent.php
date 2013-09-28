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
 * Google Drive Parent Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Drive
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Parents extends Base
{
    const URL_PARENT_LIST   = 'https://www.googleapis.com/drive/v2/files/%s/parents';
    const URL_PARENT_GET    = 'https://www.googleapis.com/drive/v2/files/%s/parents/%s';

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
     * Removes a parent from a file.
     *
     * @param string
     * @param string
     * @return array
     */
    public function delete($fileId, $parentId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_PARENT_GET, $fileId, $parentId));
    }

    /**
     * A link to the child.
     *
     * @param string
     * @return this
     */
    public function setChildLink($childLink)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');
        $this->childLink = $childLink;

        return $this;
    }

    /**
     * Lists a file's parents.
     *
     * @param string
     * @return array
     */
    public function getList($fileId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_PARENT_LIST, $fileId));
    }

    /**
     * Gets a specific parent reference.
     *
     * @param string
     * @param string
     * @return array
     */
    public function getSpecific($fileId, $parentId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_PARENT_GET, $fileId, $parentId));
    }

    /**
     * Adds a parent folder for a file.
     *
     * @param string
     * @param string
     * @return array
     */
    public function insert($fileId, $parentId)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        //populate fields
        $query = array(self::ID => $parentId);

        return $this->post(sprintf(self::URL_PARENT_LIST, $fileId), $query);
    }
}
