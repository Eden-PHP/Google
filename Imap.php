<?php//-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google;

use Eden\Mail\Imap as EdenImap;

/**
 * Imap
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Imap extends EdenImap
{
    const HOST = 'ssl://imap.gmail.com';
    const PORT = 993;


    protected $token = null;

    /**
     * Construct - Sets User and Request Token.
     *
     * @param string
     * @param string
     */
    public function __construct($user, $token)
    {
        //argument test
        Argument::i()
            ->test(1, 'string')
            ->test(2, 'string');

        $this->username = $user;
        $this->token    = $token;
    }

    /**
     * Establish the connection to the smtp
     * server.
     *
     * @param int
     * @param boolean
     * @return Eden\Mail\Imap
     */
    public function connect($timeout = self::TIMEOUT, $test = false)
    {
        Argument::i()->test(1, 'int')->test(2, 'bool');

        if ($this->socket) {
            return $this;
        }

        $errno  =  0;
        $errstr = '';

        $this->socket = @fsockopen(self::HOST, self::PORT, $errno, $errstr, $timeout);

        if (!$this->socket) {
            //throw exception
            Argument::i()
                ->setMessage(Argument::SERVER_ERROR)
                ->addVariable(self::HOST.':'.self::PORT)
                ->trigger();
        }

        if (strpos($this->getLine(), '* OK') === false) {
            $this->disconnect();
            //throw exception
            Argument::i()
                ->setMessage(Argument::SERVER_ERROR)
                ->addVariable(self::HOST.':'.self::PORT)
                ->trigger();
        }

        if ($test) {
            fclose($this->socket);

            $this->socket = null;
            return $this;
        }

        $this->send('CAPABILITY');

        $token = base64_encode("user=".$this->username."\1auth=Bearer ".$this->token."\1\1");

        //login
        $result = $this->call('AUTHENTICATE XOAUTH2 ', $token);

        //$this->disconnect();

        if (!is_array($result) || strpos(implode(' ', $result), 'OK') === false) {
            $this->disconnect();
            //throw exception
            Argument::i(Argument::LOGIN_ERROR)->trigger();
        }

        return $this;
    }
}
