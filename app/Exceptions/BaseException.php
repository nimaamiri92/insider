<?php
namespace App\Exceptions;


abstract class BaseException  extends \Exception
{
    public function displayErrorMessage()
    {
        return $this->display();
    }

    abstract public function display():string;
}