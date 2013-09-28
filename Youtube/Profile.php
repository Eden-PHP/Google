<?php //-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google\Youtube;

use Eden\Google\Base;

/**
 * Google youtube profile
 *
 * @vendor      Eden
 * @package     Google
 * @category    Youtube
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Profile extends Base
{
    const URL_YOUTUBE_PROFILE   = 'https://gdata.youtube.com/feeds/api/users/%s';
    const URL_YOUTUBE_UPLOADS   = 'https://gdata.youtube.com/feeds/api/users/%s/uploads';
    const URL_YOUTUBE_GET       = 'https://gdata.youtube.com/feeds/api/users/%s/uploads/%s';

    /* Public Properties
    -------------------------------*/
    /**
     * Construct - Set's Request Token and Developer Id
     *
     * @param string
     * @param string
     */
    public function __construct($token, $developerId)
    {
        //argument test
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string');

        $this->token        = $token;
        $this->developerId = $developerId;
    }

    /**
     * Returns a collection of videos that match the API request parameters.
     *
     * @param string
     * @return array
     */
    public function getList($userId = self::DEFAULT_VALUE)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query[self::RESPONSE] = self::JSON_FORMAT;

        return $this->getResponse(sprintf(self::URL_YOUTUBE_PROFILE, $userId), $this->query);
    }

    /**
     * Returns all videos uploaded by user,
     *
     * @param string
     * @return array
     */
    public function getUserVideoUploads($userId = self::DEFAULT_VALUE)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query[self::RESPONSE] = self::JSON_FORMAT;

        return $this->getResponse(sprintf(self::URL_YOUTUBE_UPLOADS, $userId), $this->query);
    }

    /**
     * Returns specific videos uploaded by user,
     *
     * @param string
     * @param string
     * @return array
     */
    public function getSpecificUserVideo($videoId, $userId = self::DEFAULT_VALUE)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        $this->query[self::RESPONSE] = self::JSON_FORMAT;

        return $this->getResponse(sprintf(self::URL_YOUTUBE_GET, $userId, $videoId), $this->query);
    }

    /**
     * Activate user account for youtube
     *
     * @param string
     * @param string
     * @return array
     */
    public function activateAccount($userName, $userId = self::DEFAULT_VALUE)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        //make a xml template
        $query = Template::i()
            ->set(self::USER_NAME, $userName)
            ->parsePHP(dirname(__FILE__).'/Template/Activate.php');

        return $this->put(sprintf(self::URL_YOUTUBE_PROFILE, $userId), $query);
    }
}
