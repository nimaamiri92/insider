<?php


namespace App\Actions\Repositories\Teams\TeamList;


use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateTwenty;
use App\Actions\Repositories\Teams\TeamStrategy;
use App\Contracts\Teams\TeamInterface;

class WestHam extends TeamStrategy implements TeamInterface
{
    protected $name = 'West Ham';

    public function __construct()
    {
        parent::__construct(new StrengthRateTwenty);
    }
}