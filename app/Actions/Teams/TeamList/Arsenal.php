<?php


namespace App\Actions\Teams\TeamList;

use App\Actions\Teams\TeamStrategy;
use App\Actions\Teams\TeamBehavior\StrengthRateSeventy;
use App\Contracts\Teams\TeamInterface;

class Arsenal extends TeamStrategy implements TeamInterface
{
    public function __construct()
    {
        parent::__construct(new StrengthRateSeventy);
    }

    protected $name = 'Arsenal';


    public function initTeam(): void
    {
        // TODO: Implement initTeam() method.
    }
}