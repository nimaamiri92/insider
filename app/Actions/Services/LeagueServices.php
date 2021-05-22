<?php


namespace App\Actions\Services;


use App\Actions\Models\League;
use App\Actions\Models\Match;
use App\Actions\Models\Point;
use App\Actions\Repositories\LeagueRepository;
use App\Actions\Repositories\TeamRepository;

class LeagueServices extends BaseServices
{
    const FIRST_WEEK = 0;

    protected $leagueRepository;

    protected $teamRepository;

    protected $predictionService;

    private $simulateMatch;

    public function __construct()
    {
        parent::__construct(new League);
        $this->teamRepository = new TeamRepository;
        $this->leagueRepository = new LeagueRepository;
        $this->predictionService = new PredictionService;
        $this->simulateMatch = new SimulateGamePlay;
    }

    public function createNewLeague()
    {
        if ($this->leagueRepository->policy->isInMiddleOfLeague()) {
            return $this->leagueRepository->getLeagueCurrentState();
        }

        $randTeams = $this->teamRepository->selectRandomTeam();
        $this->model->setLeagueTeams($randTeams);
        $this->initTeamsPoints();
        $this->model->setCurrentWeek(self::FIRST_WEEK);
        $allGames = $this->createHomeAndAwayMatches($this->model->getLeagueTeams());
        $this->model->setGames($allGames);
        $gamesWeekTable = $this->setEachWeekGame();
        $this->model->setGameWeeksTable($gamesWeekTable);
        $this->model->setPrediction($this->predictionService->setUpList($randTeams));
        return $this->model->save($this->model->getTableName(), $this->model);
    }

    public function playNextWeek()
    {
        $league = $this->leagueRepository->getLeagueCurrentState();
        $nextWeekMatches = $this->leagueRepository->getNextWeekMatch();
        if (!$nextWeekMatches) {
            return false;
        }
        $this->simulateMatch->setMatch($nextWeekMatches)->play()->getResult();
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
        foreach ($league->getGameWeeksTable() as $match) {
            $league->updateCurrentWeek();
            $this->simulateMatch->setMatch($match)->play()->getResult();
        }
        $predictionList = $this->predictionService->updateList($league);
        $league->setPrediction($predictionList);
    }

    public function newLeague()
    {
        $this->model->refresh();
    }


    private function createHomeAndAwayMatches($teams, &$matches = [], &$rawMatchesDetails = [],
                                              $matchesPermutation = [])
    {
        if (empty($teams)) {
            $rawMatchesDetails = $this->getMatch($matchesPermutation, $rawMatchesDetails);
            $matches = $this->addMatchAndPreventDuplicatedMatch($rawMatchesDetails, $matches);

        } else {
            for ($i = count($teams) - 1; $i >= 0; --$i) {
                $newTeams = $teams;
                $newPermutation = $matchesPermutation;
                list($team) = array_splice($newTeams, $i, 1);
                array_unshift($newPermutation, $team);
                $this->createHomeAndAwayMatches($newTeams, $matches, $rawMatchesDetails, $newPermutation);
            }
        }
        return $matches;
    }

    private function initTeamsPoints()
    {
        $teams = $this->model->getLeagueTeams();
        foreach ($teams as &$eachTeam) {
            $eachTeam->points = new Point();
        }
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

    /**
     * @param $perms
     * @param $rawMatches
     * @return mixed
     */
    private function getMatch($perms, $rawMatches)
    {
        $rawMatches[] = $firstMatchOfWeek = array_slice($perms, 0, 2);
        $rawMatches[] = $secondMatchOfWeek = array_slice($perms, 2, 2);
        $rawMatches[] = array_reverse($firstMatchOfWeek);
        $rawMatches[] = array_reverse($secondMatchOfWeek);
        return $rawMatches;
    }

    /**
     * @param       $rawMatches
     * @param array $matches
     * @return array
     */
    private function addMatchAndPreventDuplicatedMatch($rawMatches, array $matches): array
    {
        foreach ($rawMatches as $match) {
            //create associative match name array
            $matchName = $match[0]->getName() . ' VS ' . $match[1]->getName();

            if (empty($match[$matchName])) {
                $matches[$matchName] = $match;
            }
        }
        return $matches;
    }


}