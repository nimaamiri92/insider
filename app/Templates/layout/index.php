<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="app/Resources/css/main.css">
</head>
<body>
<div class="main">
    <div class="bottom">
        <?php
        if(isset($bottom) )require( \App\Components\Response::Path()).$bottom;

        ?>
    </div>
    <h3>All Matches::</h3>
    <table class="table full-width" >
        <thead>
        <tr>
            <td>Week</td>
            <td >Matches</td>
            <td>Status</td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($table as $week => $WeekMatches){
            list($firstMatch,$secondMatch) = $WeekMatches['matches'];

            $teamOne = $firstMatch->getFirstTeamData();
            $teamTwo = $firstMatch->getSecondTeamData();
            $teamThree = $secondMatch->getFirstTeamData();
            $teamFour = $secondMatch->getSecondTeamData();
            ?>
            <tr>
                <td rowspan="2">
                    <?="Week_$week"?>
                </td>
                <td>
                    <?= $teamOne->getName()?> <b>VS</b>
                    <?= $teamTwo->getName()?>
                </td>
                <td><?= $firstMatch->isDone() ? $firstMatch->getStringResult() :'Not DONE' ?></td>
            </tr>
            <tr>
                <td>
                    <?= $teamThree->getName()?> <b>VS</b>
                    <?= $teamFour->getName()?>
                </td>
                <td><?= $secondMatch->isDone() ? $secondMatch->getStringResult() :'Not DONE' ?></td>
            </tr>
            <?php
        }
        ?>


        </tbody>
    </table>


    <h3 class="margin-top-50">Teams Game Result::</h3>
        <table class="table full-width">
            <thead>
            <tr>
                <td colspan="7">
                    League Table
                </td>
                <td>
                    Match Results
                </td>
            </tr>
            <tr>
            </thead>
            <tr>
                <td>Teams</td>
                <td>PTS</td>
                <td>P</td>
                <td class="green">W</td>
                <td>D</td>
                <td class="red">L</td>
                <td>GD</td>
                <td rowspan="5">
                    <?php
                       foreach ($prediction as $teamName => $teamPrediction){
                   ?>
                           <div>
                               <span class="purple"><?=$teamName?></span> <?=$teamPrediction?>% <BR>
                           </div>
                    <?php
                       }
                    ?>


                </td>
            </tr>
            <?php
            if (!empty($teams))
                foreach ($teams as $team){
                    $points = $team->points;
                    ?>
                    <tr>
                        <td><?=$team->getName() ?></td>
                        <td class="center"><?=$points->getPts() ?></td>
                        <td class="center"><?=$points->getGamesCount() ?></td>
                        <td class="green center"><?=$points->getW() ?></td>
                        <td class="center"><?=$points->getD() ?></td>
                        <td class=" red center"><?=$points->getL() ?></td>
                        <td class="center"><?=$points->getTotalGD() ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>


        <?php if ($currentWeek < 6){?>
            <form action="" method="get" class="floated">
                <input type="hidden" name="controller" value="league">
                <input type="hidden" name="method" value="nextWeek">
                <input class="btn-green" type="submit" value="Next week" />
            </form>
            <?php
            if ($currentWeek == 0){
            ?>
                <form action="" class="floated">
                    <input type="hidden" name="controller" value="league">
                    <input type="hidden" name="method" value="playAllMatches">
                    <input class="btn-blue" type="submit" value="Play All" />
                </form>
            <?php
                }
            ?>
        <?php }else{ ?>
            <form action="">
                <input type="hidden" name="controller" value="league">
                <input type="hidden" name="method" value="newLeague">
                <input class="btn-red" type="submit" value="New League" />
            </form>
        <?php } ?>

</div>
</body>
</html>