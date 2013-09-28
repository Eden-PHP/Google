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
 * Google Youtube Upload
 *
 * @vendor      Eden
 * @package     Google
 * @category    Youtube
 * @author      Charles Zamora charles.andacc@gmail.com
 */
class Upload extends Base
{
    const URL_YOUTUBE_UPLOAD = 'http://uploads.gdata.youtube.com/action/GetUploadToken';

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
     * Get upload token
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @return array
     */
    public function getUploadToken($title, $description, $category, $keyword, $userId = self::DEFAULT_VALUE)
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

        //make a xml template
        $query = Template::i()
            ->set(self::TITLE, $title)
            ->set(self::DESCRIPTION, $description)
            ->set(self::CATEGORY, $category)
            ->set(self::KEYWORD, $keyword)
            ->parsePHP(dirname(__FILE__).'/Template/Upload.php');

        return $this->upload(sprintf(self::URL_YOUTUBE_UPLOAD, $userId), $query);
    }

    /**
     * Upload video to youtube
     *
     * @return form
     */
    public function upload($uploadToken, $postUrl, $redirectUrl)
    {
        //argument test
        Argument::i()
            ->test(1, 'object', 'string')       //argument 1 must be a object or string
            ->test(2, 'object', 'string')       //argument 2 must be a object or string
            //argument 3 must be a string
            ->test(3, 'string');

        //make a xml template
        $query = Template::i()
            ->set(self::UPLOAD_TOKEN, $uploadToken)
            ->set(self::REDIRECT_URL, $redirectUrl)
            ->set(self::POST_URL, $postUrl)
            ->parsePHP(dirname(__FILE__).'/Template/Form.php');

        return $query;
    }
}
