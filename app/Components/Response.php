<?php


namespace App\Components;

class Response
{
    protected $_headers = [];
    protected $_cookies = [];
    protected $_content = '';


    public function addCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httpOnly = null)
    {
        $this->_cookies[$name] = [
            'value' => $value,
            'expire' => $expire,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'http' => $httpOnly,
        ];
    }

    public function deleteCookie($name)
    {
        unset($this->_cookies[$name]);
    }

    public function addHeader($name, $value)
    {
        $this->_headers [$name] = $value;
    }

    public function removeHeader($name)
    {
        unset($this->_headers[$name]);
    }

    public function setContent($content)
    {
        $this->_content = $content;
    }

    public static function Path()
    {
        return ROOT . '/app/Templates/';
    }

    public static function Render($template, $data)
    {
        extract($data);
        ob_start();
        require static::Path() . $template;
        return ob_get_clean();
    }

    public function sendOutput()
    {
        if ($this->_headers) {
            foreach ($this->_headers as $header => $value) {
                header($header . ': ' . $value);
            }
        }
        if ($this->_cookies) {
            foreach ($this->_cookies as $cookie => $data) {
                setcookie($cookie, $data['value'], $data['expire'], $data['path'], $data['domain'], $data['secure'], $data['http']);
            }
        }
        echo $this->_content;
    }
}