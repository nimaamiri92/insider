<?php


namespace App\Exceptions;

class InvalidActionException  extends BaseException
{
    const MESSAGE = 'Bad Method call';

    public function display(): string
    {
        return self::MESSAGE;
    }
}