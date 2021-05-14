<?php


namespace App\Actions\Repositories\Teams\TeamList;


use App\Actions\Repositories\Teams\TeamBehavior\StrengthRateEighty;
use App\Actions\Repositories\Teams\TeamStrategy;
use App\Contracts\Teams\TeamInterface;

class ManCity extends TeamStrategy implements TeamInterface
{
    protected $name = 'Man City';

    public function __construct()
    {
        parent::__construct(new StrengthRateEighty);
    }
}