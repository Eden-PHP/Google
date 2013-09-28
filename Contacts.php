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
 * Google Contacts
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Contacts extends Base
{
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
     * Returns Google contacts batch
     *
     * @return Contacts_Batch
     */
    public function batch()
    {

        return Contacts_Batch::i($this->token);
    }

    /**
     * Returns Google contacts data
     *
     * @return Contacts_Batch
     */
    public function data()
    {

        return Contacts_Data::i($this->token);
    }

    /**
     * Returns Google contacts groups
     *
     * @return Contacts_Groups
     */
    public function groups()
    {

        return Contacts_Groups::i($this->token);
    }

    /**
     * Returns Google contacts photo
     *
     * @return Contacts_Photo
     */
    public function photo()
    {

        return Contacts_Photo::i($this->token);
    }
}
