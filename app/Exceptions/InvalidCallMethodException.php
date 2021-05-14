<?php


namespace App\Exceptions;

class InvalidCallMethodException  extends BaseException
{
    const MESSAGE = 'Bad Method call';

    public function display(): string
    {
        return self::MESSAGE;
    }
}