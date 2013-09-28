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
 * Google youtube message
 *
 * @vendor      Eden
 * @package     Google
 * @category    Youtube
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Message extends Base
{
    const URL_YOUTUBE_MESSAGE       = 'https://gdata.youtube.com/feeds/api/users/%s/inbox';
    const URL_YOUTUBE_MESSAGE_GET   = 'https://gdata.youtube.com/feeds/api/users/%s/inbox/%s';

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
     * Retrieve all user's contacts
     *
     * @param string
     * @return array
     */
    public function getList($userId = self::DEFAULT_VALUE)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->query[self::RESPONSE] = self::JSON_FORMAT;

        return $this->getResponse(sprintf(self::URL_YOUTUBE_MESSAGE, $userId), $this->query);
    }

    /**
     * Send a video message
     *
     * @param string
     * @param string
     * @param string
     * @return array
     */
    public function sendMessage($videoId, $summary, $userName)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string')
            //argument 3 must be a string
            ->test(3, 'string');

        //make a xml template
        $query = Template::i()
            ->set(self::VIDEO_ID, $videoId)
            ->set(self::SUMMARY, $summary)
            ->parsePHP(dirname(__FILE__).'/Template/SendMessage.php');

        return $this->post(sprintf(self::URL_YOUTUBE_MESSAGE, $userName), $query);
    }

    /**
     * Delete a message
     *
     * @param string
     * @param string
     * @return array
     */
    public function delete($messageId, $userId = self::DEFAULT_VALUE)
    {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string
            ->test(2, 'string');

        return $this->delete(sprintf(self::URL_YOUTUBE_MESSAGE_GET, $userId, $messageId));
    }
}
