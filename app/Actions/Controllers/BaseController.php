<?php


namespace App\Actions\Controllers;


use App\Application;

class BaseController
{
    public function __construct()
    {
        $this->app = Application::getInstance();
    }
}