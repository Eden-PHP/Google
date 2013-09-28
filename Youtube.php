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
 * Google youtube
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Youtube extends Base
{

    /**
     * Construct - Set's Request Token and
     * Developer Id.
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

        $this->token    = $token;
        $this->developerId  = $developerId;
    }

    /**
     * Factory method for youtube activity
     *
     * @return Youtube_Activity
     */
    public function activity()
    {
        return Youtube_Activity::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube channel
     *
     * @return Youtube_Channel
     */
    public function channel()
    {
        return Youtube_Channel::i($this->token);
    }

    /**
     * Factory method for youtube comment
     *
     * @return Youtube_Activity
     */
    public function comment()
    {
        return Youtube_Comment::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube contacts
     *
     * @return Youtube_Contacts
     */
    public function contacts()
    {
        return Youtube_Contacts::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube favorites
     *
     * @return Youtube_Favorites
     */
    public function favorites()
    {
        return Youtube_Favorites::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube history
     *
     * @return Youtube_History
     */
    public function history()
    {
        return Youtube_History::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube message
     *
     * @return Youtube_Message
     */
    public function message()
    {
        return Youtube_Message::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube playlist
     *
     * @return Youtube_Playlist
     */
    public function playlist()
    {
        return Youtube_Playlist::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube profile
     *
     * @return Youtube_Profile
     */
    public function profile()
    {
        return Youtube_Profile::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube ratings
     *
     * @return Youtube_Ratings
     */
    public function ratings()
    {
        return Youtube_Ratings::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube search
     *
     * @return Youtube_Search
     */
    public function search()
    {
        return Youtube_Search::i($this->token);
    }

    /**
     * Factory method for youtube subscription
     *
     * @return Youtube_Subscription
     */
    public function subscription()
    {
        return Youtube_Subscription::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube upload
     *
     * @return Youtube_Upload
     */
    public function upload()
    {
        return Youtube_Upload::i($this->token, $this->developerId);
    }

    /**
     * Factory method for youtube video
     *
     * @return Youtube_Video
     */
    public function video()
    {
        return Youtube_Video::i($this->token);
    }
}
