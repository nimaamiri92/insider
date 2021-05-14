<?php

namespace App\Components;

class Request
{
    /**
     * @var DottedArray
     */
    protected $_server;
    /**
     * @var DottedArray
     */
    protected $_post;
    /**
     * @var DottedArray
     */
    protected $_get;
    /**
     * @var DottedArray
     */
    protected $_cookie;

    protected $_requestMethod = '';

    public function __construct()
    {
        $this->_server = new DottedArray($_SERVER);
        $this->_get = new DottedArray($_GET);
        $this->_post = new DottedArray($_POST);
        $this->_cookie = new DottedArray($_COOKIE);
        $this->_requestMethod = strtoupper($this->_server->get('REQUEST_METHOD'));
    }

    /**
     * Get request method (uppercase)
     */
    public function getMethod()
    {
        return $this->_requestMethod;
    }

    public function isPost()
    {
        return ($this->getMethod() === 'POST');
    }

    public function get($key, $default = null)
    {
        return $this->_get->get($key, $default);
    }
    public function post($key, $default = null)
    {
        return $this->_post->get($key, $default);
    }
    public function cookie($key, $default = null)
    {
        return $this->_cookie->get($key, $default);
    }


}