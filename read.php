<?php
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
  $day = "";
  $weights = "";
  $bodyfats = "";
  // var_dump($result);
  // exit();


  // var_dump($result[0]["date"]);
  // exit();
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $day .= "{$record["date"]}','";
    $weights .= "{$record["weight"]}','";
    $bodyfats .= "{$record["bodyfat"]}','";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <title>体重一覧画面</title>
</head>

<body>
  <fieldset>
    <legend>体重一覧画面</legend>
    <a href="input.php">入力画面</a>
    <h1>グラフ</h1>
    <canvas id="myChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['<?= $day ?>'],
          datasets: [{
            //棒グラフ
            label: "体重",
            data: ['<?= $weights ?>'],
            backgroundColor: "rgba(0,0,128,0.5)",
            yAxisID: 'left-y-axis'
          }, {
            //折れ線グラフ
            label: "体脂肪",
            type: 'line',
            data: ['<?= $bodyfats ?>', ],
            borderColor: "rgba(255,255,0,1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'right-y-axis'
          }]
        },
        options: {
          title: {
            display: true,
            text: '日付・体重 体脂肪'
          },
          scales: {
            yAxes: [{
              id: 'left-y-axis',
              position: 'left',
              ticks: {
                suggestedMax: 100,
                suggestedMin: 40,
                stepSize: 5,
                callback: function(value, index, values) {
                  return value + 'kg'
                }
              }
            }, {
              id: 'right-y-axis',
              position: 'right',
              ticks: {
                suggestedMax: 50,
                suggestedMin: 10,
                stepSize: 10,
                callback: function(value, index, values) {
                  return value + '％'
                }
              },
              // グリッドラインを消す
              gridLines: {
                drawOnChartArea: false,
              },
            }]
          }
        }
      });
    </script>
  </fieldset>
</body>

</html>