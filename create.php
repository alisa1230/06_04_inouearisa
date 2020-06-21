<?php

// 送信確認

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
// 入力チェック(未入力の場合は弾く，commentのみ任意) if (
if (
  !isset($_POST['datetime']) || $_POST['datetime'] == '' ||
  !isset($_POST['weight']) || $_POST['weight'] == '' ||
  !isset($_POST['bodyfat']) || $_POST['bodyfat'] == '' ||
  !isset($_POST['memo']) || $_POST['memo'] == ''

) {
  exit('ParamError');
}
// var_dump($_POST);
// exit();


// 受け取ったデータを変数に入れる
$datetime = $_POST['datetime'];
$weight = $_POST['weight'];
$bodyfat = $_POST['bodyfat'];
$memo = $_POST['memo'];


// DB接続の設定
// DB名は`gsacf_x00_00`にする
$dbn = 'mysql:dbname=gsacf_d06_04;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  // ここでDB接続処理を実行する
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// var_dump($_POST);
// exit();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する

// SQL準備&実行
$sql = 'INSERT INTO weightLoss(date, weight,bodyfat,memo)
          VALUES(:datetime, :weight ,:bodyfat, :memo)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
$stmt->bindValue(':bodyfat', $bodyfat, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);

$status = $stmt->execute(); // SQLを実行

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  // データ登録失敗次にエラーを表示
  exit('sqlError:' . $error[2]);
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header('Location:input.php');
}
