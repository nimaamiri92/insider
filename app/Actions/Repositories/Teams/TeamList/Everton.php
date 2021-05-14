<?php


namespace App\Actions\Repositories\Teams\TeamList;



use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateFifty;
use App\Actions\Repositories\Teams\TeamStrategy;
use App\Contracts\Teams\TeamInterface;

class Everton extends TeamStrategy implements TeamInterface
{
    protected $name = 'Everton';

    public function __construct()
    {
        parent::__construct(new StrengthRateFifty);
    }
}