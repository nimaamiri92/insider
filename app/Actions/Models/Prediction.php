<?php


namespace App\Actions\Models;


class Prediction extends BaseModel
{
    private $teamPercentage = 0;

    private $teamName = null;

    /**
     * @return int
     */
    public function getTeamPercentage(): int
    {
        return $this->teamPercentage;
    }

    /**
     * @param int $teamPercentage
     */
    public function setTeamPercentage(int $teamPercentage): void
    {
        $this->teamPercentage = $teamPercentage;
    }

    /**
     * @return null
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * @param null $teamName
     */
    public function setTeamName($teamName): void
    {
        $this->teamName = $teamName;
    }
}