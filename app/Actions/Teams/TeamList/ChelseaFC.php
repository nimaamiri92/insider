<?php


namespace App\Actions\Teams\TeamList;


use App\Actions\Teams\TeamStrategy;
use App\Actions\Teams\TeamBehavior\StrengthRateEighty;
use App\Contracts\Teams\TeamInterface;

class ChelseaFC extends TeamStrategy implements TeamInterface
{
    protected $name = 'Chelsea F.C.';

    public function __construct()
    {
        parent::__construct(new StrengthRateEighty);
    }
}