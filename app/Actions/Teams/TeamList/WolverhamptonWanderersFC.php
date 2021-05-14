<?php


namespace App\Actions\Teams\TeamList;


use App\Actions\Teams\TeamStrategy;
use App\Actions\Teams\TeamBehavior\StrengthRateTwenty;
use App\Contracts\Teams\TeamInterface;

class WolverhamptonWanderersFC extends TeamStrategy implements TeamInterface
{
    protected $name = 'Wolverhampton Wanderers F.C.';
    public function __construct()
    {
        parent::__construct(new StrengthRateTwenty);
    }
}