<?php
session_start();

require_once '../classes/UserLogic.php';

// エラーメッセージ
$err = [];

// バリデーション

//未記入の場合
//if文を用いる時、通常、変数定義を先にして、if文の条件式を書くが、変数定義をif文の条件式内に書くことも可能。
//この場合、ポストで受け取ったemailが入っていない(filter input の結果がfalse の場合)$errにメッセージが入る。
//ここでは値が入っているかどうかのみの判断（bool)
if (!$email = filter_input(INPUT_POST, 'email')) {
    $err['email'] = 'メールアドレスを記入してください。';
}

//ここでは値が入っているかどうかのみの判断（bool)
if (!$password = filter_input(INPUT_POST, 'password')) {
    $err['password'] = 'パスワードを記入してください。';
}



//エラーがあった場合(値が一致しているかはおいといて、値が入っているかどうか）は、エラーメッセージつきでlogin.phpにもどるためのif文を作る
if (count($err) > 0) {
    //エラーがあった場合は$err（メッセージを含むバリデーションの２つのif)を挿入した上でheader関数を使って、locationに指定された場所にリダイレクト。
    $_SESSION = $err;
    //レスポンスヘッダー関数（引数がlocationのみの場合)= 指定されたURLに移動する。
    header('location:login_form.php');
    return;
}
//上記のバリデーションをクリアした際の処理
//email,passswordが入力されていることは確認できたので、次はlogin関数でそれらがデータベースの情報とマッチするかどうかを調べる。
$result = UserLogic::login($email, $password);


//ログイン失敗時の処理
if (!$result) {
    header('location:login_form.php');
    return;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン完了</title>
</head>

<body>
    <h2>ログイン完了</h2>
    <p> ログインしました</p>

    <a href="./mypage.php">マイページへ</a>

</body>

</html>