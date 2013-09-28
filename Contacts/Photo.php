<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Contacts;

use Eden\Google\Base;

/**
 * Google Contacts Photos
 *
 * @package Eden
 * @category google
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Photo extends Base
{
    const URL_CONTACTS_GET_IMAGE = 'https://www.google.com/m8/feeds/photos/media/%s/%s';

    /**
     * Construct - Set's the Request Token
     *
     * @param string
     */
    public function __construct($token)
    {
        //argument test
        Argument::i()->test(1, 'string');
        $this->token    = $token;
    }

    /**
     * Retrieve a single contact photo
     *
     * @param string
     * @param string
     * @return array
     */
    public function getImage($contactId, $userEmail = self::DAFAULT)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        //populate fields
        $query = array(
            self::VERSION   => self::VERSION_THREE,
            self::RESPONSE  => self::JSON_FORMAT);

        return $this->getResponse(sprintf(self::URL_CONTACTS_GET_IMAGE, $userEmail, $contactId), $query);
    }

    /**
     * Delete a photo
     *
     * @param string
     * @param string
     * @return array
     */
    public function delete($contactId, $userEmail = self::DAFAULT)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_CONTACTS_GET_IMAGE, $userEmail, $contactId), true);
    }
}
