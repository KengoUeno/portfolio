<?php
session_start();
require_once '../classes/UserLogic.php';


$result=UserLogic::checkLogin();
//ログインがされていなければ新規画面へ行く処理
if(!$result){
  $_SESSION['login_err']='ユーザー登録してログインしてください';
  header('location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

//データベースに登録されている人数を数える関数
$user_number = UserLogic::countUser();



 //各種トレーニングの記録を全ユーザーと比較して順位を求める関数
$bench_record = UserLogic::rankingBench();
$squat_record = UserLogic::rankingSquat();
$dead_record = UserLogic::rankingDead();
  
  


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
</head>
<body>
    <h2>マイページ</h2>
  
  <img src="https://icooon-mono.com/i/icon_00146/icon_001460_256.png" alt="">

  <p>ユーザーID: <?php echo $login_user['id'] ?></p>
  <p>ログインユーザ:<?php echo $login_user['name']?></p>
  <p>メールアドレス:<?php echo $login_user['email']?></p>
  
  

  <h2>BIG3の1RM記録を更新する</h2>
  <p>*記録を更新した種目のみ下記の数値を偏子してください。</p>
  
  <form action="record.php" method="post">
    <label>ベンチプレス</label>
    <input type="text" name="bench" value="<?php echo $login_user['bench'];?>"> kg <br>
    <label>スクワット</label>
    <input type="text" name="squat" value="<?php echo $login_user['squat'];?>">  kg <br>
    <label>デッドリフト</label>
    <input type="text" name="dead" value="<?php echo $login_user['dead'];?>"> kg <br>
    <input type="hidden" name="id" value="<?php echo $login_user['id'] ?>">
    <input type="submit" name="submit" value="記録を登録する">
   
  </form>



  <h2>現在のあなたランキング(登録者　<?php echo $user_number["count(id)"] ; ?> 人中)</h2>
  <form action="mypage.php" method="post">
    <p>ベンチプレス   <?php echo $bench_record+1;   ?>位</p>
    <p>スクワット   <?php echo $squat_record+1;   ?>位</p>
    <p>デッドリフト   <?php echo $dead_record+1;   ?>位</p>
    
  </form>

  <p><a href="ranking.php">部内ランキング表</a> </p>
  
  
  <br>


  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="ログアウト">
  </form>


  
</body>
</html>