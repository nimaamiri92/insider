<?php


namespace App\Actions\Policies;


use App\Components\DB\DB;
use App\Contracts\Repositories\RepositoryInterface;
use App\Exceptions\LeagueNotFinishedYet;

class LeaguePolicy
{

    protected $_isInMiddleOfLeague = false;

    private $leagueRepository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->leagueRepository = $repository;
    }

    public function isInMiddleOfLeague()
    {
        $leagueData = $this->leagueRepository->getLeagueCurrentState();

        if (!$leagueData){
            return $this->_isInMiddleOfLeague;
        }

        if ($leagueData->getCurrentWeek()) {
            $this->_isInMiddleOfLeague = true;
        }

        return $this->_isInMiddleOfLeague;
    }
}