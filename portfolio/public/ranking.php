<?php
session_start();
require_once '../classes/UserLogic.php';


$benchAll = UserLogic::allBench();
$squatAll = UserLogic::allSquat();
$deadAll = UserLogic::allDead();

$index_bench = UserLogic::rankingAll();
$index_squat = UserLogic::rankingAll();
$index_dead = UserLogic::rankingAll();







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ランキング表</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="./style.css">



</head>

<body>

    <header>

        <h1>現在のランキング</h1>

    </header>

    <div class="goback">
        <a href="mypage.php">マイページへ</a>
        <a href="index.php">ホームへ</a>
    </div>


    <div class="your-result">

        <div class="ranking">

            <div class="rank">
                <h2>ベンチプレス</h2>
                <table>

                    <thead>
                        <tr>
                            <th>順位</th>
                            <th>重量</th>
                            <th>名前</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($benchAll as $benchRow) : ?>
                            <tr>
                                <td><?php echo $index_bench++; ?></td>
                                <td><?php echo $benchRow['bench']; ?> kg</td>
                                <td><?php echo $benchRow['name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

            <div class="rank">
                <h2>スクワット</h2>
                <table>

                    <thead>
                        <tr>
                            <th>順位</th>
                            <th>重量</th>
                            <th>名前</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($squatAll as $squatRow) : ?>
                            <tr>
                                <td><?php echo $index_squat++; ?></td>
                                <td><?php echo $squatRow['squat']; ?> kg </td>
                                <td><?php echo $squatRow['name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

            <div class="rank">

                <h2>デッドリフト</h2>
                <table>
                    <thead>
                        <tr>
                            <th>順位</th>
                            <th>重量</th>
                            <th>名前</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($deadAll as $deadRow) : ?>
                            <tr>
                                <td><?php echo $index_dead++; ?></td>
                                <td><?php echo $deadRow['dead']; ?> kg</td>
                                <td><?php echo $deadRow['name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


</body>

</html>