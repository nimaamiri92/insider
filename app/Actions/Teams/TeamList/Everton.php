<?php


namespace App\Actions\Teams\TeamList;


use App\Actions\Teams\TeamStrategy;
use App\Actions\Teams\TeamBehavior\StrengthRateFifty;
use App\Contracts\Teams\TeamInterface;

class Everton extends TeamStrategy implements TeamInterface
{
    protected $name = 'Everton';

    public function __construct()
    {
        parent::__construct(new StrengthRateFifty);
    }
}