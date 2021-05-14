<?php


namespace App\Exceptions;


class NotFoundException  extends BaseException
{
    const Message = 'not found entity';

    public function display(): string
    {
        return self::Message;
    }
}