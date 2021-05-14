<?php


namespace App\Actions\Teams\TeamBehavior;


use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class StrengthRateFifty implements StrengthRateInterface
{

    public function getRate(): int
    {
        return 50;
    }
}