<?php


namespace App\Actions\Models;


class Match extends BaseModel
{
    private $winnerTeamName = null;

    private $isMatchFinishedDraw = false;

    private $isDone = false;

    private $firstTeamGoals = 0;

    private $secondTeamGoals = 0;

    private $firstTeamData;

    private $secondTeamData;

    public function __construct($matchTeams)
    {
        list($firstTeam,$secondTeam) = $matchTeams;
        $this->setFirstTeamData($firstTeam);
        $this->setSecondTeamData($secondTeam);
    }

    /**
     * @return mixed
     */
    public function getWinnerTeamName()
    {
        return $this->winnerTeamName;
    }

    /**
     * @param mixed $winnerTeamName
     */
    public function setWinnerTeamName($winnerTeamName): void
    {
        $this->winnerTeamName = $winnerTeamName;
    }


    /**
     * @return bool
     */
    public function isMatchFinishedDraw(): bool
    {
        return $this->isMatchFinishedDraw;
    }

    /**
     * @param bool $isMatchFinishedDraw
     */
    public function setIsMatchFinishedDraw(bool $isMatchFinishedDraw): void
    {
        $this->isMatchFinishedDraw = $isMatchFinishedDraw;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @param bool $isDone
     */
    public function setIsDone(bool $isDone): void
    {
        $this->isDone = $isDone;
    }

    /**
     * @return int
     */
    public function getFirstTeamGoals(): int
    {
        return $this->firstTeamGoals;
    }

    /**
     * @param int $firstTeamGoals
     */
    public function setFirstTeamGoals(int $firstTeamGoals): void
    {
        $this->firstTeamGoals = $firstTeamGoals;
    }

    /**
     * @return int
     */
    public function getSecondTeamGoals(): int
    {
        return $this->secondTeamGoals;
    }

    /**
     * @param int $secondTeamGoals
     */
    public function setSecondTeamGoals(int $secondTeamGoals): void
    {
        $this->secondTeamGoals = $secondTeamGoals;
    }

    /**
     * @return mixed
     */
    public function getFirstTeamData()
    {
        return $this->firstTeamData;
    }

    /**
     * @param mixed $firstTeamData
     */
    public function setFirstTeamData($firstTeamData): void
    {
        $this->firstTeamData = $firstTeamData;
    }

    /**
     * @return mixed
     */
    public function getSecondTeamData()
    {
        return $this->secondTeamData;
    }

    /**
     * @param mixed $secondTeamData
     */
    public function setSecondTeamData($secondTeamData): void
    {
        $this->secondTeamData = $secondTeamData;
    }

    public function getStringResult()
    {
        return $this->getFirstTeamGoals() . ' - ' . $this->getSecondTeamGoals();
    }
}