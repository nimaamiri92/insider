<?php


namespace App\Actions\Controllers;


use App\Actions\Repositories\LeagueRepository;
use App\Actions\Services\LeagueServices;
use App\Components\Response;
use App\Exceptions\LeagueNotStartedYet;

class LeagueController extends BaseController
{
    private $leagueService;
    private $leagueRepository;

    public function __construct()
    {
        parent::__construct();
        $this->leagueService = new LeagueServices;
        $this->leagueRepository = new LeagueRepository;
    }

    public function startNewLeague()
    {
        $league = $this->leagueService->createNewLeague();

        $data = [
            'currentWeek' => $league->getCurrentWeek(),
            'teams' => $league->getLeagueTeams(),
            'table' => $league->getGameWeeksTable(),
            'prediction' => $league->getPrediction(),
        ];

        $content = Response::Render('layout/index.php', $data);
        $this->app->response()->setContent($content);

    }

    public function nextWeek()
    {
        $this->leagueService->playNextWeek();
        $league = $this->leagueRepository->getLeagueCurrentState();

        if (!$league){
            throw new LeagueNotStartedYet;
        }
        $data = [
            'currentWeek' => $league->getCurrentWeek(),
            'teams' => $league->getLeagueTeams(),
            'table' => $league->getGameWeeksTable(),
            'prediction' => $league->getPrediction(),
        ];

        $content = Response::Render('layout/index.php', $data);
        $this->app->response()->setContent($content);
    }

    public function playAllMatches()
    {
        $this->leagueService->playAllMatches();
        $league = $this->leagueRepository->getLeagueCurrentState();

        $data = [
            'currentWeek' => $league->getCurrentWeek(),
            'teams' => $league->getLeagueTeams(),
            'table' => $league->getGameWeeksTable(),
            'prediction' => $league->getPrediction(),
        ];

        $content = Response::Render('layout/index.php', $data);
        $this->app->response()->setContent($content);
    }

    public function newLeague()
    {
        $this->leagueService->newLeague();
        $league = $this->leagueService->createNewLeague();

        $data = [
            'currentWeek' => $league->getCurrentWeek(),
            'teams' => $league->getLeagueTeams(),
            'table' => $league->getGameWeeksTable(),
            'prediction' => $league->getPrediction(),
        ];

        $content = Response::Render('layout/index.php', $data);
        $this->app->response()->setContent($content);
    }

    public function showLeagueChart()
    {
        $league = $this->leagueRepository->getLeagueCurrentState();
        $data = [
            'currentWeek' => $league->getCurrentWeek(),
            'teams' => $league->getLeagueTeams(),
            'table' => $league->getGameWeeksTable(),
            'prediction' => $league->getPrediction(),
        ];

        $content = Response::Render('layout/index.php', $data);
        $this->app->response()->setContent($content);
    }
}