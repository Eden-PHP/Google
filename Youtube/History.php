<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Google\Youtube;

use Eden\Google\Base;

/**
 * Google youtube history
 *
 * @vendor      Eden
 * @package     Google
 * @category    Youtube
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class History extends Base
{
    const URL_YOUTUBE_HISTORY       = 'https://gdata.youtube.com/feeds/api/users/default/watch_history';
    const URL_YOUTUBE_HISTORY_GET   = 'https://gdata.youtube.com/feeds/api/users/default/watch_history/%s';
    const URL_YOUTUBE_HISTORY_CLEAR = 'https://gdata.youtube.com/feeds/api/users/default/watch_history/actions/clear';

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

        $this->token            = $token;
        $this->developerId      = $developerId;
    }

    /**
     * Retrieve a user's watch history feed.
     *
     * @return array
     */
    public function getList()
    {
        $this->query[self::VERSION] = self::VERSION_TWO;
        $this->query[self::RESPONSE]    = self::JSON_FORMAT;

        return $this->getResponse(sprintf(self::URL_YOUTUBE_HISTORY), $this->query);
    }

    /**
     * Delete a specific history
     *
     * @param string
     * @return array
     */
    public function deleteSpecific($historyId)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        return $this->delete(sprintf(self::URL_YOUTUBE_HISTORY_GET, $historyId));
    }

    /**
     * Clear history
     *
     * @return array
     */
    public function clearHistory()
    {
        //call block to format xml files
        $query = $this->Youtube_Block_Clear();

        return $this->post(sprintf(self::URL_YOUTUBE_HISTORY_CLEAR), $query);
    }
}
