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
 * Google Drive Children Class
 *
 * @vendor      Eden
 * @package     Google
 * @category    Drive
 * @author      Christian Blanquera cblanquera@openovate.com
 */
class Children extends Base
{
    const URL_CHILDREN_LIST     = 'https://www.googleapis.com/drive/v2/files/%s/children';
    const URL_CHILDREN_SPECIFIC = 'https://www.googleapis.com/drive/v2/files/%s/children/%s';

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
     * Removes a child from a folder
     *
     * @param string
     * @param string
     * @return array
     */
    public function delete($folderId, $childId)
    {
        //argument test
        Argument::i()
            //argunemt 1 must be a string
            ->test(1, 'string')
            //argunemt 2 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_CHILDREN_SPECIFIC, $fileId, $childId));
    }

    /**
     * Returns list of folder's children
     *
     * @param string
     * @return array
     */
    public function getList($folderId)
    {
        //argument test
        Argument::i()->test(1, 'string');

        return $this->getResponse(sprintf(self::URL_CHANGES_LIST, $folderId));
    }

    /**
     * Gets a specific child reference
     *
     * @param string
     * @param string
     * @return array
     */
    public function getSpecific($folderId, $childId)
    {
        //argument test
        Argument::i()
            //argunemt 1 must be a string
            ->test(1, 'string')
            //argunemt 2 must be a string
            ->test(2, 'string');

        return $this->getResponse(sprintf(self::URL_CHILDREN_SPECIFIC, $fileId, $childId));
    }

    /**
     * Inserts a file into a folder
     *
     * @param string
     * @param string
     * @return array
     */
    public function insert($folderId, $childId)
    {
        //argument test
        Argument::i()
            //argunemt 1 must be a string
            ->test(1, 'string')
            //argunemt 2 must be a string
            ->test(2, 'string');

        //populate fields
        $query = array(self::ID => $childId);

        return $this->post(sprintf(self::URL_CHANGES_LIST, $folderId), $query);
    }
}
