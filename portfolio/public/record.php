<?php 
require_once "../classes/UserLogic.php";


//mypage.php からのpost, トレーニング記録の更新をする関数。
$personal_record = UserLogic::renewPR($_POST,);

echo $personal_record;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><a href="mypage.php">マイページへ戻る</a>
</body>
</html>