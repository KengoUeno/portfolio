<?

// //三項演算子＝if文を使わなくても条件分岐ができる　p107
// //下記の三項演算子を省略構文にすると
// //$login_err=isset($SESSION['login_err]) ?: null;　となる
 $login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err']:null;

 unset($_SESSION['login_err']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
    <h2>新規登録</h2>
        <?php if(isset($login_err)): ?>
            <p><?php echo $login_err; ?></p>
        <?php endif; ?>
    <form action="register.php" method="post">
        <label for="username">ユーザー名</label>
        <input type="text" name="username"><br>

        <label for="email">メールアドレス</label>
        <input type="email" name="email"><br>
 
        <label for="password">パスワード</label>
        <input type="password" name="password"><br>

        <label for="password_conf">確認用パスワード</label>
        <input type="password" name="password_conf"><br>
        
        
        <input type="submit" value="新規登録"> 

       

        


            
    </form>
            
    <a href="login_form.php">ログインはこちら</a><br>
    <a href="index.php">ホームに戻る</a>
</body>
</html>