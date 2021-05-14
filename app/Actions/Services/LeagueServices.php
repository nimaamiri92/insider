<?php


namespace App\Actions\Services;


use App\Actions\Models\League;
use App\Actions\Models\Match;
use App\Actions\Models\Team;
use App\Actions\Repositories\LeagueRepository;
use App\Actions\Repositories\TeamRepository;

class LeagueServices extends BaseServices
{
    protected $leagueRepository;

    protected $teamRepository;

    protected $predictionService;

    public function __construct()
    {
        parent::__construct(new League);
        $this->teamRepository = new TeamRepository;
        $this->leagueRepository = new LeagueRepository;
        $this->predictionService = new PredictionService;
    }

    public function createNewLeague()
    {
        if ($this->leagueRepository->policy->isInMiddleOfLeague()) {
            return $this->leagueRepository->getLeagueCurrentState();
        }

        $randTeams = $this->teamRepository->selectRandomTeam();
        $this->model->setLeagueTeams($randTeams);
        $this->initTeamsPoints();
        $this->model->setCurrentWeek(0);//TODO::convert to const
        $allGames = $this->createHomeAndAwayMatches($this->model->getLeagueTeams());
        $this->model->setGames($allGames);
        $gamesWeekTable = $this->setEachWeekGame();
        $this->model->setGameWeeksTable($gamesWeekTable);
        $predictionList = $this->predictionService->setUpList($randTeams);
        $this->model->setPrediction($predictionList);
        return $this->model->save($this->model->getTableName(), $this->model);
    }

    public function playNextWeek()
    {
        $league = $this->leagueRepository->getLeagueCurrentState();
        $nextWeekMatches = $this->leagueRepository->getNextWeekMatch();
        if (!$nextWeekMatches){
            return false;
        }
        (new SimulateGamePlay($nextWeekMatches))->play()->getResult();
        $league->updateCurrentWeek();
        $predictionList = $this->predictionService->updateList($league);
        $league->setPrediction($predictionList);
    }

    public function playAllMatches()
    {
        if ($this->leagueRepository->policy->isInMiddleOfLeague()) {
            return $this->leagueRepository->getLeagueCurrentState();
        }

        $league = $this->leagueRepository->getLeagueCurrentState();
        foreach ($league->getGameWeeksTable() as $match){
            $league->updateCurrentWeek();
            (new SimulateGamePlay($match))->play()->getResult();
        }
        $predictionList = $this->predictionService->updateList($league);
        $league->setPrediction($predictionList);
    }

    public function newLeague()
    {
        $this->model->refresh();
    }

    //TODO::refactor this
    private function createHomeAndAwayMatches($teams, &$matches = [], &$rawMatches = [], $perms = [])
    {
        $matches = [];
        if (empty($teams)) {
            $rawMatches[] = $weekHomeMatchArr1 = array_slice($perms, 0, 2);
            $rawMatches[] = $weekHomeMatchArr2 = array_slice($perms, 2, 2);
            $rawMatches[] = array_reverse($weekHomeMatchArr1);
            $rawMatches[] = array_reverse($weekHomeMatchArr2);


            foreach ($rawMatches as $match) {
                $matchName = $match[0]->getName() . ' VS ' . $match[1]->getName();

                if (empty($match[$matchName])) {
                    $matches[$matchName] = $match;
                }
            }

        } else {
            for ($i = count($teams) - 1; $i >= 0; --$i) {
                $newitems = $teams;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                $this->createHomeAndAwayMatches($newitems, $matches, $rawMatches, $newperms);
            }
        }
        return $matches;
    }

    private function initTeamsPoints()
    {
        $teams = $this->model->getLeagueTeams();
        foreach ($teams as &$eachTeam) {
            $eachTeam->points = new Team();
        }
        $this->model->setLeagueTeams($teams);
    }

    private function setEachWeekGame()
    {
        $gamesWeekTable = [];
        $games = $this->model->getGames();
        $weekNum = 1;

        while ($games) {
            $matchOneTeams = array_pop($games);
            $matchTwoTeams = array_pop($games);
            $gamesWeekTable[$weekNum] = [
                'matches' => [
                    new Match($matchOneTeams),
                    new Match($matchTwoTeams),
                ]
            ];

            $weekNum++;
        }

        return $gamesWeekTable;
    }



}