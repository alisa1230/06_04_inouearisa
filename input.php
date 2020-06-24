<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重管理</title>
</head>

<body>
  <script src="camera.js"></script>
  <form action="create.php" method="POST">
    <fieldset>
      <legend>体重入力画面</legend>
      <a href="read.php">一覧画面</a>

      <div>
        日にち: <input type="date" name="datetime">
      </div>
      <div>
        体重: <input type="text" name="weight">
      </div>
      <div>
        体脂肪: <input type="text" name="bodyfat">
      </div>
      <div>
        メモ: <input type="text" name="memo">
      </div>

      <video id="vid" width="300" height="200"></video>
      <canvas id="canv" width="300" height="200"></canvas>
      <form>
        <div>
          <button>submit</button>
        </div>
      </form>
      <button type="button" id="shutter">シャッター</button>
      <button id="download">download</button>
    </fieldset>



</body>

</html>