<?php

//1RMの計算
$max100 =  round($_POST["weight"] / (1.0278 - 0.0278 * $_POST["repetition"]));
$max95 = round($max100 * 0.95);
$max90 = round($max100 * 0.9);
$max85 = round($max100 * 0.85);
$max80 = round($max100 * 0.8);
$max75 = round($max100 * 0.75);
$max70 = round($max100 * 0.7);
$max65 = round($max100 * 0.65);
$max60 = round($max100 * 0.6);
$max55 = round($max100 * 0.55);
$max50 = round($max100 * 0.5);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>◯◯高校野球部トレーニング記録</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>


        <div class="header-logo">
            <img src="https://illustcut.com/box/silhouette/pitcher1/pitcher01_06.png" alt="">

        </div>

        <div class="header-bar">
            <a href="signup_form.php">部員登録</a>
            <a href="login.php">ログイン</a>
        </div>




    </header>



    <main>
        <div class="top-wrapper">


            <div class="contents">
                <!-- ロゴをいれる -->


                <div class="main-title">
                    <h1>◯◯高校野球部トレーニング記録</h1>
                </div>

                <div class="sub-message">
                    <p>このサイトでは筋力の最大パワーを数値化し、登録している部員間での比較、競争することができます。そして、野球選手として自分が理想とする身体作りに最も適したトレーニングプログラムの構築をサポートします。</p>
                </div>


            </div>

            <div class="registration">
                <a href="signup_form.php">部員登録してランキングをつける</a>
            </div>

        </div>


        <div class="contents-wrapper">
            <div class="rm-calculator">
                <h2>まずは自分の1RMを知ろう!</h2><br>
                <h3>1RM(1 Repetiton Maximum)とは、正しいフォームで１回だけ持ち上げることができる「最大重量」です。<br>まずは好きな重さ（５〜１０回は持ち上げられそうな重量）で限界までやってみましょう！ </h3>

                <div class="calculate-form">
                    <form action="index.php" method="post">
                        <p>

                            <label>トレーニングの種目 </label>
                            <select name="training-menu">
                                <option value="0">選択してください</option>
                                <option value="1">ベンチプレス</option>
                                <option value="2">スクワット</option>
                                <option value="3">デッドリフト</option>
                            </select><br>

                        </p><br>

                        <p>

                            <label>扱った重量</label>
                            <input type="text" name="weight"> kg<br>

                        </p><br>

                        <p>
                            <label>持ち上げた回数 </label>
                            <input type="text" name="repetition"> rep<br>
                        </p><br>
                        <p>

                            <input type="submit" name="submit" value="1RMを計算する">

                        </p>



                    </form>

                </div>

            </div>
        </div>

        <div class="your-result">
            <div class="check-result">

                <h2>あなたの1RMは <span><?php echo $max100; ?></span> kgです。 </h2><br>
                <a href="login_form.php">記録更新を更新する</a>
                <a href="signup_form.php">新規の方はこちら</a>

            </div>

            <br>
            <br>



            <div class="rm-table">

                <table class="table">
                    <tbody>
                        <tr>
                            <th>パワー（％）</th>
                            <th>重量</th>
                            <th>持ち上げられる回数</th>
                        </tr>
                        <td>100%</td>
                        <td><?php echo $max100; ?>kg</td>
                        <td>1</td>
                        <tr>

                        </tr>
                        <td>95%</td>
                        <td><?php echo $max95; ?>kg</td>
                        <td>2</td>
                        <tr>

                        </tr>
                        <td>90%</td>
                        <td><?php echo $max90; ?>kg</td>
                        <td>4</td>
                        <tr>

                        </tr>
                        <td>85%</td>
                        <td><?php echo $max85; ?>kg</td>
                        <td>6</td>
                        <tr>

                        </tr>
                        <td>80%</td>
                        <td><?php echo $max80; ?>kg</td>
                        <td>8</td>
                        <tr>

                        </tr>
                        <td>75%</td>
                        <td><?php echo $max75; ?>kg</td>
                        <td>10</td>
                        <tr>

                        </tr>
                        <td>70%</td>
                        <td><?php echo $max70; ?>kg</td>
                        <td>12</td>
                        <tr>

                        </tr>
                        <td>65%</td>
                        <td><?php echo $max65; ?>kg</td>
                        <td>16</td>
                        <tr>

                        </tr>
                        <td>60%</td>
                        <td><?php echo $max60; ?>kg</td>
                        <td>20</td>
                        <tr>

                        </tr>
                        <td>55%</td>
                        <td><?php echo $max55; ?>kg</td>
                        <td>24</td>
                        <tr>

                        </tr>
                        <td>50%</td>
                        <td><?php echo $max50; ?>kg</td>
                        <td>30</td>
                        <tr>

                        </tr>

                    </tbody>


                </table>

            </div>


        </div>


        <div class="advise">
            <div class="model">
                <img src="https://i2.wp.com/ai-catcher.com/wp-content/uploads/cut91d_fukidashi_nashi-1.png?resize=360%2C270&ssl=1" alt="">
            </div>

            <div class="message">
                <p>- 筋肉の強さを求めるなら<span><?php echo round($max85, -1), 'kgから', round($max95, -1), 'kg' ?></span> の重さでトレーニング！</p>
                <p>- 筋肉を大きくしたいなら<span><?php echo round($max70, -1), 'kgから', round($max80, -1), 'kg' ?></span> の重さでトレーニング！</p>
                <p>- 持久力のある筋肉が欲しいなら<span><?php echo round($max50, -1), 'kgから', round($max65, -1), 'kg' ?></span>の重さでトレーニング！</p>
            </div>



        </div>





    </main>


    <footer>
        <div class="footer-contents">

            <ul class="follow-me">
                <ul>
                    <li><a href="https://www.instagram.com/kengo_fit_sc_jp/" target="_blank"><img src="https://i1.wp.com/www.globemart.co.jp/newwp/wp-content/uploads/2020/07/png-transparent-instagram-application-logo-logo-computer-icons-instagram-miscellaneous-text-trademark.png" alt=""></a></li>
                    <li><a href="https://www.facebook.com/kengo.ueno.75470" target="_blank"><img src="data:image/jpeg;base64,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" alt=""></a></li>

                </ul>
            </ul>

            <div class="aboutus">
                <p>About us</p>
                <p>FAQ</p>
                <p>Privacy Policy</p>
            </div>

            <div class="contactus">
                <p>contact us</p>
                <p>Phone: 000-0000-000</p>
                <p>Email: aiueo@gmail.com</p>
            </div>



        </div>

    </footer>

</body>

</html>