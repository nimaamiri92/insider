<?php


namespace App\Exceptions;


class LeagueNotStartedYet extends BaseException
{

    const MESSAGE = 'you should start league before doing matches';

    public function display(): string
    {
        return self::MESSAGE;
    }
}