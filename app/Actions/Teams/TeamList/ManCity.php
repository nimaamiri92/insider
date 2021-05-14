<?php


namespace App\Actions\Teams\TeamList;


use App\Actions\Teams\TeamStrategy;
use App\Actions\Teams\TeamBehavior\StrengthRateEighty;
use App\Contracts\Teams\TeamInterface;

class ManCity extends TeamStrategy implements TeamInterface
{
    protected $name = 'Man City';

    public function __construct()
    {
        parent::__construct(new StrengthRateEighty);
    }
}