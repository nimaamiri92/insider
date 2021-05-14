<?php


namespace App\Actions\Repositories;


use App\Actions\Models\League;
use App\Components\DB\DB;

class LeagueRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new League);
    }

    public function getLeagueCurrentState()
    {
        return $this->model->getLeagueCurrentState();
    }

    public function getNextWeekMatch()
    {
        $league = $this->getLeagueCurrentState();
        if (!$league){
            return null;
        }
        $weeks = $league->getGameWeeksTable();
        foreach ($weeks as $week){
            if (!($week['matches'][0])->isDone()){
                return $week;
            }
        }
    }
}