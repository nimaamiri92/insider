<?php


namespace App\Components\DB;


use App\Application;
use App\Contracts\Components\DBInterface;
use App\Exceptions\NotFoundException;

class DB implements DBInterface
{

    private static $instance;
    private $_client;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): DB
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }


    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
        $app = Application::getInstance();
        $this->_client = $app->session();
    }

    public function get(string $key)
    {
        if (!$data = $this->_client->get($key)) {
            return null;
        }
        return $data;
    }

    public function set(string $key, $value)
    {
        $this->_client->set($key, $value);
        return $value;
    }

    public function refresh(): bool
    {
        $this->_client->refresh();
        return true;
    }

    public function delete(string $key): bool
    {
        $this->_client->unset($key);
        return true;
    }
}