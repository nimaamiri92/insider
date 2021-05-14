<?php


namespace App\Actions\Models;


use App\Components\DB\DB;

class League extends BaseModel
{
    public $tableName = 'league';

    private $_week = 0;

    private $_team;

    private $_gameWeeksTable;

    private $_games;

    private $_prediction;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getCurrentWeek(): int
    {
        return $this->_week;
    }

    /**
     * @param int $week
     */
    public function setCurrentWeek(int $week): void
    {
        $this->_week = $week;
    }


    public function updateCurrentWeek(): void
    {
        $this->_week += 1;
    }

    /**
     * @return mixed
     */
    public function getLeagueTeams()
    {
        return $this->_team;
    }

    /**
     * @param mixed $team
     */
    public function setLeagueTeams($team): void
    {
        $this->_team = $team;
    }

    /**
     * @return mixed
     */
    public function getGameWeeksTable()
    {
        return $this->_gameWeeksTable;
    }

    /**
     * @param mixed $gameTable
     */
    public function setGameWeeksTable($gameTable): void
    {
        $this->_gameWeeksTable = $gameTable;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->_games;
    }

    /**
     * @param mixed $games
     */
    public function setGames($games): void
    {
        $this->_games = $games;
    }

    public function getLeagueCurrentState()
    {
        return DB::getInstance()->get($this->tableName);
    }

    public function refresh()
    {
        return DB::getInstance()->refresh();
    }

    /**
     * @return mixed
     */
    public function getPrediction()
    {
        return $this->_prediction;
    }

    /**
     * @param mixed $prediction
     */
    public function setPrediction($prediction): void
    {
        $this->_prediction = $prediction;
    }


}