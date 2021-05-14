<?php


namespace App\Actions\Repositories\Teams;

use App\Actions\Repositories\Teams\TeamList\Arsenal;
use App\Actions\Repositories\Teams\TeamList\BurnleyFC;
use App\Actions\Repositories\Teams\TeamList\ChelseaFC;
use App\Actions\Repositories\Teams\TeamList\Everton;
use App\Actions\Repositories\Teams\TeamList\ManCity;
use App\Actions\Repositories\Teams\TeamList\WestHam;
use App\Actions\Repositories\Teams\TeamList\WolverhamptonWanderersFC;
use App\Contracts\Teams\TeamBehavior\StrengthRateInterface;

class TeamStrategy
{
    protected $strengthRate;

    public function __construct(StrengthRateInterface $strengthRate)
    {
        $this->strengthRate = $strengthRate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return int
     */
    public function getStrengthRate(): int
    {
        return $this->strengthRate->getRate();
    }

    public static function listOfTeams()
    {
        return[
            new Arsenal,
            new BurnleyFC,
            new ChelseaFC,
            new Everton,
            new ManCity,
            new WestHam,
            new WolverhamptonWanderersFC,
        ];
    }
}