<?php


namespace App\Components\Session;


use App\Application;

class Session implements SessionInterface
{

    public function start()
    {
        $app = Application::getInstance();
        session_start([
            'name' => $app->config('session.cookie'),
        ]);
    }

    public function delete()
    {
        session_destroy();
    }

    public function save()
    {
        session_write_close();
    }

    public function set($name, $value)
    {
        $_SESSION [$name] = $value;
    }

    public function unset($name)
    {
        if (isset($_SESSION [$name]))
            unset($_SESSION [$name]);
    }

    public function get($name)
    {
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];
        else
            return null;
    }

    public function refresh()
    {
        $_SESSION = [];
    }
}