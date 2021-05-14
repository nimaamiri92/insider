<?php


namespace App\Actions\Repositories\Teams\TeamBehavior;


use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class strengthRateNinety implements StrengthRateInterface
{

    public function getRate(): int
    {
        return 90;
    }
}