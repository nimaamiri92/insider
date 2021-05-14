<?php


namespace App\Actions\Repositories\Teams\TeamList;


use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateTwenty;
use App\Actions\Repositories\Teams\TeamStrategy;
use App\Contracts\Teams\TeamInterface;

class BurnleyFC extends TeamStrategy implements TeamInterface
{
    protected $name = 'Burnley F.C.';

    public function __construct()
    {
        parent::__construct(new StrengthRateTwenty);
    }
}