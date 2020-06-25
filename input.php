<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重管理</title>
</head>

<body>
  <form action="create.php" method="POST">
    <fieldset>
      <legend>体重入力画面</legend>

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

      <form>
        <div>
          <button>submit</button>
          <a href="form.html">写真撮る画面へ</a>
        </div>
      </form>

    </fieldset>



</body>

</html>