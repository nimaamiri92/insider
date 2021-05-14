<?php


namespace App\Actions\Repositories\Teams\TeamList;


use App\Actions\Repositories\Teams\TeamStrategy;
use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateTwenty;
use App\Contracts\Teams\TeamInterface;

class WolverhamptonWanderersFC extends TeamStrategy implements TeamInterface
{
    protected $name = 'Wolverhampton Wanderers F.C.';
    public function __construct()
    {
        parent::__construct(new StrengthRateTwenty);
    }
}