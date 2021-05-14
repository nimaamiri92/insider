<?php


namespace App\Actions\Teams\Repositories\Repositories\TeamBehavior;


use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class strengthRateTen implements StrengthRateInterface
{

    public function getRate(): int
    {
        return 10;
    }
}