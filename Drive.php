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
 * Google Drive API factory
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Drive extends Base
{
    const URL_DRIVE_ABOUT   = 'https://www.googleapis.com/drive/v2/about';
    const URL_DRIVE_APPS    = 'hhttps://www.googleapis.com/drive/v2/apps';

    /**
     * Construct - Set's the Request Token.
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
     * Returns Google Drive Changes
     *
     * @return Drive_Changes
     */
    public function changes()
    {
        return Drive_Changes::i($this->token);
    }

    /**
     * Returns Google Drive Children
     *
     * @return Drive_Children
     */
    public function children()
    {
        return Drive_Children::i($this->token);
    }

    /**
     * Returns Google Drive Files
     *
     * @return Drive_Files
     */
    public function files()
    {
        return Drive_Files::i($this->token);
    }

    /**
     * Gets the information about the
     * current user along with Drive API settings
     *
     * @return array
     */
    public function getAbout()
    {
        return $this->getResponse(self::URL_DRIVE_ABOUT);
    }

    /**
     * Lists a user's apps.
     *
     * @return array
     */
    public function getApps()
    {
        return $this->getResponse(self::URL_DRIVE_APPS);
    }

    /**
     * Returns Google Drive parent
     *
     * @return Drive_Parent
     */
    public function parents()
    {
        return Drive_Parent::i($this->token);
    }

    /**
     * Returns Google Drive Permissions
     *
     * @return Drive_Permissions
     */
    public function permissions()
    {
        return Drive_Permissions::i($this->token);
    }

    /**
     * Returns Google Drive Revisions
     *
     * @return Drive_Revisions
     */
    public function revisions()
    {
        return Drive_Revisions::i($this->token);
    }
}
