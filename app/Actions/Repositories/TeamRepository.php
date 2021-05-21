<?php


namespace App\Actions\Repositories;



use App\Actions\Models\Team;
use App\Actions\Repositories\Teams\TeamStrategy;

class TeamRepository extends BaseRepository
{
    private const NUMBER_OF_RANDOM_TEAM = 4;

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
        foreach (array_rand($allTeams,self::NUMBER_OF_RANDOM_TEAM) as $eachTeam){
            $randTeams[] = $allTeams[$eachTeam];
        }

        return $randTeams;
    }
}