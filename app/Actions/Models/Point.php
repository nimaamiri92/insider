<?php


namespace App\Actions\Models;


class Point extends BaseModel
{
    private $TotalGD = 0;
    private $pts = 0;
    private $gamesCount = 0;
    private $w = 0;
    private $l = 0;
    private $d = 0;
    private $predictionPercentage = 0;

    public function getTotalGD(): int
    {
        return $this->TotalGD;
    }

    public function setTotalGD(int $TotalGD): void
    {
        $this->TotalGD = $TotalGD;
    }

    public function updateTotalGD(int $TotalGD): void
    {
        $this->TotalGD += $TotalGD;
    }

    public function getPts(): int
    {
        return $this->pts;
    }

    public function setPts(int $pts): void
    {
        $this->pts = $pts;
    }

    public function updatePts(int $pts): void
    {
        $this->pts += $pts;
    }

    public function getGamesCount(): int
    {
        return $this->gamesCount;
    }


    public function setGamesCount(int $gamesCount): void
    {
        $this->gamesCount = $gamesCount;
    }
    public function updateGamesCount(int $gamesCount): void
    {
        $this->gamesCount += $gamesCount;
    }

    /**
     * @return int
     */
    public function getW(): int
    {
        return $this->w;
    }

    /**
     * @param int $w
     */
    public function setW(int $w): void
    {
        $this->w = $w;
    }

    public function updateW(): void
    {
        $this->w += 1;
    }

    /**
     * @return int
     */
    public function getL(): int
    {
        return $this->l;
    }

    /**
     * @param int $l
     */
    public function setL(int $l): void
    {
        $this->l = $l;
    }

    public function updateL(): void
    {
        $this->l += 1;
    }

    /**
     * @return int
     */
    public function getD(): int
    {
        return $this->d;
    }

    /**
     * @param int $d
     */
    public function setD(int $d): void
    {
        $this->d = $d;
    }

    public function updateD(): void
    {
        $this->d += 1;
    }

    /**
     * @return int
     */
    public function getPredictionPercentage(): int
    {
        return $this->predictionPercentage;
    }

    /**
     * @param int $predictionPercentage
     */
    public function setPredictionPercentage(int $predictionPercentage): void
    {
        $this->predictionPercentage = $predictionPercentage;
    }

}