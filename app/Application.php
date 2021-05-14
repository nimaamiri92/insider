<?php

namespace App;


use App\Actions\Controllers\LeagueController;
use App\Components\DottedArray;
use App\Components\Request;
use App\Components\Response;
use App\Exceptions\BaseException;
use App\Exceptions\InvalidActionException;
use App\Exceptions\InvalidCallMethodException;

final class Application
{

    private $_request;

    protected $_response;

    protected $_config;

    protected $_session;


    public function run()
    {
        try {
            $this->_session->start();
            $controller = $this->findController();
            $method = $this->findMethod();
            call_user_func([$controller, $method]);
        } catch (BaseException $exception) {
            $data = [
                'title' => 'Error!',
                'error' => $exception->displayErrorMessage(),
            ];
            $content = Response::Render('layout/intr    o.php', $data);
            $this->response()->setContent($content);

        }
        $this->_response->sendOutput();

    }


    private function findController()
    {
        $request = $this->request();
        $controller = $request->get('controller');
        if (!$controller || !strlen(trim($controller)))
            $controller = 'league';

        $controller = ucfirst($controller);
        $class = '\\App\\Actions\\Controllers\\' . $controller . 'Controller';

        if (class_exists($class))
            return new $class ();
        else
            throw new InvalidActionException();

    }

    private function findMethod()
    {
        $request = $this->request();
        $method = $request->get('method');
        if (!$method || !strlen(trim($method)))
            $method = 'startNewLeague';

        return $method;
    }


    public function request()
    {
        return $this->_request;
    }

    public function response()
    {
        return $this->_response;
    }

    public function session()
    {
        return $this->_session;
    }

    public function config($key, $default = null)
    {
        return $this->_config->get($key, $default);
    }


    /**
     * @var Application
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): Application
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }


    private function __construct()
    {
        $this->_config = new DottedArray(include ROOT . DS . 'app' . DS . 'Config' . DS . 'app.php');
        $class = $this->config('session.class');
        $this->_session = new $class();
        $this->_request = new Request();
        $this->_response = new Response();
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    protected function __wakeup()
    {
    }
}

?>