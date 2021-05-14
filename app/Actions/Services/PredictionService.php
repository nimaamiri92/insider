<?php


namespace App\Actions\Services;


use App\Actions\Models\Prediction;
use App\Actions\Repositories\LeagueRepository;
use App\Actions\Repositories\TeamRepository;

class PredictionService extends BaseServices
{
    public function __construct()
    {
        parent::__construct(new Prediction);
        $this->teamRepository = new TeamRepository;
        $this->leagueRepository = new LeagueRepository;
    }


    public function setUpList($teams)
    {
        $list = [];
        foreach ($teams as $team){
            $teamName = $team->getName();
            $list[$teamName] = 0;
        }

        return $list;
    }

    public function updateList($leagueResult)
    {
        $totalPts = 0;
        $list = [];
       foreach ($leagueResult->getLeagueTeams() as $team){
           $totalPts += $team->points->getPts();

       }

       foreach ($leagueResult->getLeagueTeams() as $eachTeam){
           $list[$eachTeam->getName()] =  round(( $eachTeam->points->getPts() / $totalPts) * 100);
       }

       return $list;
    }
}