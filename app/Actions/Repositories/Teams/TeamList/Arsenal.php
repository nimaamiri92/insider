<?php


namespace App\Actions\Repositories\Teams\TeamList;

use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateSeventy;
use App\Actions\Repositories\Teams\TeamStrategy;
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