<?php
//データベースへの登録が必要になるので、dbconnectをこのページに読見込む
require_once '../dbconnect.php';
class UserLogic{
//クラス内なので、変数=プロパティ、関数=メソッドと呼ぶ

                     /**
             * ユーザを登録処理
             * @param array $userData
             * @return bool $result
             */
            //ユーザー情報を登録するための静的メソッド(createUser)を作成

                    //ここのcreateUsser($userData)とregister.php のcreateUser($_POST)では、
                    //引数が違う変数だけど、関数名が同じなので、phpが自動で同じ引数として解釈してくれるらしい。（たくやさんより）
                    public static function createUser($userData,){
                      //最初に$resultをfalseにすることで、後半のtry 文が実行された場合、true に書き換え。
                      //もし例外処理にひっかかってcatch にいった場合、そのまま$result=falseで実行される。
                      //下のtry分で処理が行われる前に、try分の中で使う変数や配列を準備しておく
                      $result = false;
                      //SQL文 ?はプレースホルダー
                      $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

                      // ユーザデータを配列に入れる
                      $arr = [];
                      $arr[] = $userData['username']; //VALUESの最初の?にnameを入れる。
                      $arr[] = $userData['email']; //VALUESの二番目の?にemailを入れる。
                      $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT); //VALUESの最後の?にpasswordをハッシュ化して入れる。

                      //データベースの処理を行うときは必ず例外処理(try catch 文)でかこむ。
                      try {
                          //上記の$sqlに書いたSQL文を準備する。データベースへの接続(dbconnect)が必要。
                          //$stmt変数に値を渡す。
                          //　本来下記の文は$stmt=$pdo-> prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)';)とかく場合が普通。
                          //しかし今回の場合、line 26　でdbへinsertする情報を$sql変数に代入しているので、prepareの引数は$sqlでよい。
                          //connect()は本来、dbconnect内のの$pdoであることが普通だが、今回はファイルdbconnectのconnect関数でインスタンス化されreturnされている$pdoを取得する。
                        $stmt = connect() -> prepare($sql);
                        //execute($arr)は「prepareされた$sqlのVALUEの?,?,?,に$arrの値が入っていく。
                        $result = $stmt->execute($arr);
                        return $result;
                      } catch(\Exception $e) {
                        echo $e; // エラーを出力
                        error_log($e, 3, '../error.log'); //ログを出力
                        
                        return $result;
                      }
                    }




            /**
             * ログイン処理
             * @param string $email
             * @param string $password
             * @return bool $result
             */
            //ログインを行うための静的メソッド(login)を作成。
            //変数定義されていないのでわかりずらいが、$email,$passwordはpostで受け取った値が入る。
            public static function login($email,$password)
            {
                    $result=false;

                    //ユーザーをemailから検索して取得、$userに代入。
                    //同じクラス内(self::）の下記にあるpublic static function getUsersByEmailにアクセス
                    //ここはloginメソッドの{}内なので、別のメソッド(今回はgetUserByEmail)にアクセスする場合はself::が必要ってこと？
                    //ここで$userにはデータベースの引数email(つまりはログイン中のemail)をもつユーザーの情報が配列で入っている。
                    $user = self::getUserByEmail($email);
                    //上記の$userに入っているのは配列である

                     if(!$user){
                       $_SESSION['msg']='emailが一致しません';
                     return $result;
                    }

                    //パスワード照会
                    //password_verifyメソッド(ビルトイン関数)を使って、
                    if(password_verify($password,$user['password'])){
                      //ログイン成功の場合,,,
                      //セッションハイジャック対策で、session_regenerate_idメソッド(ビルトイン関数)
                      //を使ってセッションIDを新しく作成する。
                      session_regenerate_id(true);
                      //配列$user を＄session[]に代入
                      $_SESSION['login_user']=$user;
                      $result=true;
                      return $result;
                    }

                    $_SESSION['msg']='パスワードが一致しません';
                        return $result;

            }




            /**
             * データベースに老録されているユーザー情報をemailを元に取得
             * @param string $email
             * @return arry|bool $user|false
             */
            
            public static function getUserByEmail($email)
            {
                      //mySQLに登録されているユーザー情報をemailを元に取得する
                      //?(placeholder)にはgetUserByEmail($email)で取得した値をいれる。
                      $sql = 'SELECT * FROM users WHERE email = ?';

                      // emailを配列に入れる
                      $arr = [];
                      $arr[] = $email;
                      
                      
                      try {
                          //上記の$sqlに書いたSQL文を準備する。データベースへの接続(dbconnect)が必要。
                          //$stmt変数に値を渡す。
                        $stmt = connect() -> prepare($sql);
                        //$arrの配列(ここではメールアドレス)を実行
                        $stmt->execute($arr);
                        //SQLの結果を返す
                        $user = $stmt->fetch();
                        //データベースからemailを元に取得したユーザー情報(ここでは配列に$emailしか入ってないので
                        //email情報のみ)を取得、実行し、$userに代入。returnで値を返す。
                        //返された$userは上記のloginメソッド内で使われている。
  
                        return $user;

                      } catch(\Exception $e) {
                        return false ;
                      }

            }




            /**
             * ログインチェック
             * @param void
             * @return bool $result
             */

             public static function checkLogin(){

              $result=false;

              //セッション変数にlogin_userがはいいており、login_userに含まれるid情報が１以上の場合
              //＄result=falseをtrue に書き換えてリターンする。
              if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id']>0) {

                return $result = true;
              }
             
              //セッションにログインユーザーが入っていなければ最初で定義したとおりfalse

              return $result;

             }
             


             /**
             * ログアウト処理
             * 
             */

             public static function logout(){
            //まずはセッションの中身をカラにするためにarray()の引数をからにする。
              $_SESSION =array();
              session_destroy();
             }






             public static function renewPR($maxData,)
                    {
                     
                      try{
                      
                      $sql = 'UPDATE users SET bench= :bench, squat= :squat, dead= :dead WHERE id= :id';
                     
                      

                      //データベースの処理を行うときは必ず例外処理(try catch 文)でかこむ。
                      
                        
                        $stmt = connect() -> prepare($sql);
                        
                        $stmt->execute(array(':bench' => $maxData['bench'], ':squat' => $maxData['squat'], ':dead' => $maxData['dead'], 'id'=>$maxData['id']));
                        
                        
                        return '情報を更新しました';
                      } catch(\Exception $e) {
                        return $e; // エラーを出力
                        return 'エラーが発生しました';
                        
                        
                      
                      }
                    }


//-----------------------------------------------------------------------------------------------------





            public static function rankingBench()
            {
              try{
                      //ベンチプレスの重い順にデータを取得。
                $sql = 'SELECT * FROM users ORDER BY bench desc';
        
                  $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  //fetchallでデータを全て取得し$user_benchに代入
                  $users_bench=$stmt->fetchAll();

                 
        
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }

                foreach ($users_bench as $index_bench=>$user_bench )
                if($user_bench['id'] === $_SESSION['login_user']['id'])
                {
                return $index_bench ;
                }
             
            }


            public static function rankingSquat()
            {
              try{
                      
                $sql = 'SELECT * FROM users ORDER BY squat desc';
        
                  $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  $users_squat=$stmt->fetchAll();

                  
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }

                foreach ($users_squat as $index_squat=>$users_squat )
                if($users_squat['id'] === $_SESSION['login_user']['id'])
                {
                return $index_squat ;
                }
             
            }

              


            public static function rankingDead()
            {
              try{
                      
                $sql = 'SELECT * FROM users ORDER BY dead desc';
        
                  $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  $users_dead=$stmt->fetchAll();

                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }

                foreach ($users_dead as $index_dead=>$users_dead )
                if($users_dead['id'] === $_SESSION['login_user']['id'])
                {
                return $index_dead ;
                }
             
            }




            //登録ユーザーの人数を数える
            public static function countUser()
            {
              

              try{
                      
                $sql = 'SELECT count(id) FROM users';
        
                  $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  $users_count=$stmt->fetch();

                  return $users_count;

                  
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }
            }


            public static function rankingAll()
            {
              try{
                      
                $sql = 'SELECT * FROM users';
        
                  $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  $count_number=$stmt->fetchAll();

                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }

                foreach ($count_number as $i=>$number )
                
                
                return $i+1 ;
                
                
                
             
            }
              
                
                
                  
                
              

            


            // ベンチのランキングを取得する関数
            public static function allBench() {

              try{
                //データをベンチの重い順で取得する
                $sql = 'SELECT * FROM users ORDER BY bench desc';

                $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  //fetchallでデータを全て取得し$benchAll(配列）に代入
                  $benchAll=$stmt->fetchAll();

                  return $benchAll;

                 
        
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }
              }



              // スクワットのランキングを取得する関数
            public static function allSquat() {

              try{
                //データをスクワットの重い順で取得する
                $sql = 'SELECT * FROM users ORDER BY squat desc';

                $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  //fetchallでデータを全て取得し$benchAll(配列）に代入
                  $squatAll=$stmt->fetchAll();

                  return $squatAll;

                 
        
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }
              }


              // ベンチのランキングを取得する関数
            public static function allDead() {

              try{
                //データをベンチの重い順で取得する
                $sql = 'SELECT * FROM users ORDER BY dead desc';

                $stmt = connect() -> prepare($sql); 
                  $stmt->execute();
                  //fetchallでデータを全て取得し$deadAll(配列）に代入
                  $deadAll=$stmt->fetchAll();

                  return $deadAll;

                 
        
                } catch(\Exception $e) {
                  echo $e; // エラーを出力
                  echo 'エラーが発生しました';
                }
              }








            }

            
 


