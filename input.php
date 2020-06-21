<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
</head>

<body>
  <form action="create.php" method="POST">
    <fieldset>
      <legend>DB連携型todoリスト（入力画面）</legend>
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
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>