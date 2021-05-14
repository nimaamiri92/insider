<?php


namespace App\Actions\Teams\TeamList;


use App\Actions\Teams\TeamBehavior\StrengthRateTwenty;
use App\Actions\Teams\TeamStrategy;
use App\Contracts\Teams\TeamInterface;

class WestHam extends TeamStrategy implements TeamInterface
{
    protected $name = 'West Ham';

    public function __construct()
    {
        parent::__construct(new StrengthRateTwenty);
    }
}