<?php


namespace App\Actions\Services;


use App\Actions\Models\Match;

class SimulateGamePlay
{
    private $weekMatch;

    public function __construct(array $weekMatches)
    {
        $this->weekMatch = $weekMatches;
    }

    public function play()
    {

        foreach ($this->weekMatch['matches'] as &$match) {

            if (!$this->weekMatch['is_done']) {
                $teams = [
                    $match->getFirstTeamData(),
                    $match->getSecondTeamData()
                ];
                list($firstTeamGoals, $secondTeamGoals) = $this->getGoalsBaseOnTeamStrengthRate($teams);
                $this->setMatchResult($match, $teams, $firstTeamGoals, $secondTeamGoals);
            }

        }
        $this->flagThisWeekAsDone($this->weekMatch);
        return $this;
    }

    public function getResult()
    {
        return $this->weekMatch;
    }


    private function getGoalsBaseOnTeamStrengthRate($matchTeams)
    {
        $finalGoals = [];
        foreach ($matchTeams as $team) {
            $strengthRate = $team->getStrengthRate();
            if ($strengthRate > 0 && $strengthRate <= 20) {
                $goals = rand(0, 1);
            } elseif ($strengthRate > 20 && $strengthRate <= 50) {
                $goals = rand(0, 3);
            } elseif ($strengthRate > 50 && $strengthRate <= 80) {
                $goals = rand(0, 5);
            } elseif ($strengthRate > 80 && $strengthRate <= 90) {
                $goals = rand(0, 7);
            }
            $finalGoals[] = $goals;
        }

        return $finalGoals;
    }


    private function setMatchResult(Match $match, $teams, $firstTeamGoals, $secondTeamGoals): Match
    {

        $winner = $this->getWinnerName($teams, $firstTeamGoals, $secondTeamGoals);

        $match->setFirstTeamGoals($firstTeamGoals);
        $match->setSecondTeamGoals($secondTeamGoals);
        $match->setWinnerTeamName($winner);
        $match->setIsMatchFinishedDraw($firstTeamGoals == $secondTeamGoals);
        $match->setIsDone(true);

        $firstTeamPoints = $match->getFirstTeamData()->points;
        $secondTeamPoints = $match->getSecondTeamData()->points;
        $firstTeamPoints->updateTotalGD($firstTeamGoals - $secondTeamGoals);
        $secondTeamPoints->updateTotalGD($secondTeamGoals - $firstTeamGoals);

        if ($firstTeamGoals < $secondTeamGoals){
            $firstTeamPoints->updatePts(0);
            $firstTeamPoints->updateL();
            $secondTeamPoints->updatePts(3);
            $secondTeamPoints->updateW();
        }elseif ($firstTeamGoals > $secondTeamGoals){
            $firstTeamPoints->updatePts(3);
            $firstTeamPoints->updateW();
            $secondTeamPoints->updatePts(0);
            $secondTeamPoints->updateL();
        }else{
            $firstTeamPoints->updatePts(1);
            $firstTeamPoints->updateD();
            $secondTeamPoints->updatePts(1);
            $secondTeamPoints->updateD();
        }

        $firstTeamPoints->updateGamesCount(1);
        $secondTeamPoints->updateGamesCount(1);

        return $match;
    }


    private function getWinnerName($teams, $firstTeamGoals, $secondTeamGoals)
    {
        list($teamOne, $teamTwo) = $teams;
        if ($firstTeamGoals - $secondTeamGoals < 0) {
            $winner = $teamTwo;
        } elseif ($firstTeamGoals - $secondTeamGoals > 0) {
            $winner = $teamOne;
        } else {
            return null;
        }

        return $winner->getName();
    }

    private function flagThisWeekAsDone(&$weekMatch)
    {
        return $weekMatch['is_done'] = true;
    }


}