<?php


namespace App\Actions\Repositories;



use App\Actions\Models\Team;
use App\Actions\Repositories\Teams\TeamStrategy;

class TeamRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Team);
    }

    public function getAllTeams()
    {
        return TeamStrategy::listOfTeams();
    }

    public function selectRandomTeam()
    {
        $randTeams = [];
        $allTeams = $this->getAllTeams();
        foreach (array_rand($allTeams,4) as $eachTeam){
            $randTeams[] = $allTeams[$eachTeam];
        }

        return $randTeams;
    }
}