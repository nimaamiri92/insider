<?php


namespace App\Exceptions;


class LeagueNotFinishedYet extends BaseException
{
    const Message = 'You must finish current league before start new one';

    public function display(): string
    {
        return self::Message;
    }
}