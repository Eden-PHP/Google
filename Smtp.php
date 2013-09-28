<?php//-->
/*
 * This file is part of the Core package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Google;

use Eden\Mail\Smtp as EdenSmtp;

/**
 * Smtp
 *
 * @vendor  Eden
 * @package Google
 * @author  Charles Zamora charles.andacc@gmail.com
 */
class Smtp extends EdenSmtp
{
    const HOST = 'ssl://smtp.gmail.com';
    const PORT = 465;


    protected $token    = null;

    /**
     * Construct - Set's User and Request Token
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

        $this->username     = $user;
        $this->token    = $token;

        $this->boundary[] = md5(time().'1');
        $this->boundary[] = md5(time().'2');
    }


    public function connect($timeout = self::TIMEOUT, $test = false)
    {
        Argument::i()
            ->test(1, 'int')
            ->test(2, 'bool');

        if ($this->socket) {
            return $this;
        }

        $errno  =  0;
        $errstr = '';

        // $this->socket = @stream_socket_client($host.':'.$this->port, $errno, $errstr, $timeout);
        $this->socket = @fsockopen(self::HOST, self::PORT, $errno, $errstr, $timeout);

        if (!$this->socket) {
            //throw exception
            Argument::i()
                ->setMessage(Argument::SERVER_ERROR)
                ->addVariable($this->host.':'.$this->port)
                ->trigger();
        }

        if (!$this->call('EHLO '.$_SERVER['HTTP_HOST'])) {
            $this->disconnect();
            //throw exception
            Argument::i()
                ->setMessage(Argument::SERVER_ERROR)
                ->addVariable($this->host.':'.$this->port)
                ->trigger();
        }

        if ($test) {
            $this->disconnect();
            return $this;
        }

        $token = base64_encode("user=".$this->username."\1auth=Bearer ".$this->token."\1\1");

        //login
        if (!$this->call('AUTH XOAUTH2 ' . $token)) {
            $this->disconnect();
            //throw exception
            Argument::i(Argument::LOGIN_ERROR)->trigger();
        } else {
            //it does not work without this
            $this->receive();
        }

        return $this;
    }
}
