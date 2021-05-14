<?php


namespace App\Actions\Repositories\Teams\TeamBehavior;


use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class StrengthRateZero implements StrengthRateInterface
{

    public function getRate(): int
    {
        return 0;
    }
}