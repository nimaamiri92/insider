<?php


namespace App\Actions\Teams\TeamBehavior;


use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class StrengthRateTwenty implements StrengthRateInterface
{

    public function getRate(): int
    {
        return 20;
    }
}