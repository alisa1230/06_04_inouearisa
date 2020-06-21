<?php
// DB接続の設定
// DB名は`gsacf_x00_00`にする
$dbn = 'mysql:dbname=gsacf_d06_04;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';
$test = '';

try {
  // ここでDB接続処理を実行する
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// データ取得SQL作成
$sql = 'SELECT * FROM weightLoss ORDER BY date ASC';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";

  // var_dump($result);
  // exit();
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["date"]}</td>";
    $output .= "<td>{$record["weight"]}</td>";
    $output .= "<td>{$record["bodyfat"]}</td>";
    $output .= "<td>{$record["memo"]}</td>";
    $output .= "</tr>";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重一覧画面</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th>日にち</th>
          <th>体重</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>