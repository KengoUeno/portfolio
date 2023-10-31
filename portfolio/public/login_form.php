<?php
session_start();

require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if ($result) {
    header('location: mypage.php');
    return;
}


$err = $_SESSION;
//login.phpで$_SESSION=$errで、＄errの値を$_SESSIONに代入して、header関数でこのファイルにリダイレクトしたのに、
//ここでまた$err=$_SESSIONにするのはなぜ？

//ページををリロードした時に入力した内容が消えるようにする（セッションを終了させる）
$_SESSION = array();
session_destroy();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>ログイン画面</title>
</head>

<body>
    <h2>ログインフォーム</h2>
    <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">

        <label for="email">メールアドレス</label>
        <input type="email" name="email"><br>
        <?php if (isset($err['email'])) : ?>
            <p><?php echo $err['email']; ?></p>
        <?php endif; ?>


        <label for="password">パスワード</label>
        <input type="password" name="password"><br>
        <?php if (isset($err['password'])) : ?>
            <p><?php echo $err['password']; ?></p>
        <?php endif; ?>



        <input type="submit" value="ログイン">


    </form>
    <a href="signup_form.php">新規登録はこちら</a><br>
    <a href="index.php">ホームに戻る</a>
</body>

</html>