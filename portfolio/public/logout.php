<?php
session_start();
require_once '../classes/UserLogic.php';

// ログアウトボタン以外でのアクセスの場合、不正なリクエスト
if (!$logout = filter_input(INPUT_POST, 'logout')) {

  exit('不正なリクエスト');
}


//ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
//phpのセッションの有効期限は24分
$result = UserLogic::checkLogin();
//ログインがされていなければ新規画面へ行く処理
if (!$result) {
  exit('セッションがタイムアウトしました。ログインしなおしてください');
}

//ログアウト処理
UserLogic::logout();





?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログアウト</title>
</head>

<body>
  <h2>ログアウト完了</h2>

  <p>ログアウト完了しました</p>
  <a href="login_form.php">ログイン画面へ</a>




</body>

</html>