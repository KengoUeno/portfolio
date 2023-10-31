<?php

require_once '../classes/UserLogic.php';

//signup_form.php からのpost, ユーザー登録に関する関数。
// エラーメッセージ
$err = [];

//
// バリデーション
//未記入の場合
if (!$username = filter_input(INPUT_POST, 'username')) {
  //filter_input に引っ掛かったら、$err[]の配列にメッセージを代入。
  $err[] = 'ユーザ名を記入してください。';
}

//未記入の場合
if (!$email = filter_input(INPUT_POST, 'email')) {
  $err[] = 'メールアドレスを記入してください。';
}


$password = filter_input(INPUT_POST, 'password');
// 正規表現--指定されたルール通りに記入されているか。
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
  $err[] = 'パスワードは英数字8文字以上100文字以下にしてください。';
}

$password_conf = filter_input(INPUT_POST, 'password_conf');
if ($password !== $password_conf) {
  $err[] = '確認用パスワードと異なっています。';
}

//エラーの数が0だった場合、下記を実行。エラーあればスルーされる
if (count($err) === 0) {
  // ユーザを登録する処理（静的メソッドの呼び出し文、
  //新規登録画面に登録者がformに記入した内容を$_POSTで受け取り、
  //クラス（UserLogic）内の静的メソッド(createUser)に代入。

  //UserLogicクラスのcreateUser静的メソッドは、$_POSTで受け取った値をINSERT INTO でsqlにれて、
  //それが実行できたら$result =true, できなければ例外処理で$result = falseで返す。
  //つまりcreateUserメソッドから送られてくる値はbool(true or false)になる。
  $hasCreated = UserLogic::createUser($_POST,);

  //$hadCreatedにfalseが代入（例外処理が実行された場合)は、、、
  //if($変数)　はif($変数＝＝true)と同じ意味。if文の条件式にbool型(true or false)は使えないので、if(＄変数)と書く。


  if (!$hasCreated) {
    $err[] = '登録に失敗しました';
  }
}

//バリデーションで発生したエラーはhtml内にphpを埋め込んで、ユーザー側にメッセージを提示。

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録完了画面</title>
</head>

<body>
  <!-- エラーがあった場合は下記のphpを表示 -->

  <?php if (count($err) > 0) : ?>
    <!-- $errの数が0より多い（1つでもエラーがある)場合は、配列$err[]の中の値を一つずつforeachで読み込む。 -->
    <?php foreach ($err as $e) : ?>
      <p><?php echo $e ?></p>
    <?php endforeach ?>
    <!-- エラーがなければ(つまり上記のif文全てに該当(true)となるエラーがなかった場合）、echo を表示 -->
  <?php else : ?>
    <p>ユーザ登録が完了しました。</p>
  <?php endif ?>
  <a href="./signup_form.php">戻る</a>

</body>

</html>