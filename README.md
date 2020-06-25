# 06_04_inouearisa

プロダクト概要：「体重管理アプリ」です。体重と体脂肪を入力し、自分の体型を写真でとり管理するアプリになります。

＊利用する際はお手数ですが、描きコードの修正が必要になるかと思います（一部間違っているかもしれません）。。
create.php 30行目
$dbn = 'mysql:dbname=gsacf_d06_04;charset=utf8;port=3306;host=localhost';　
read.php 4行目
$file_dir  = '/Applications/XAMPP/xamppfiles/htdocs/06_04_inouearisa/06_04_inouearisa/image/';
３４行目
$dbn = 'mysql:dbname=gsacf_d06_04;charset=utf8;port=3306;host=localhost';


フォルダ階層・クラス説明：
-06-04-inouearisa
  -image/          サーバーに送信した写真がここに入ります。       
  -camera.js       シャッター・画像保存するクラスです。
  -create.php      体重入力した値をDBに詰めるクラスです。
  -form.html       写真を撮る画面です。
  -getPictures.php　imageフォルダに入った写真を一覧表示しています。
  -input.php        体重入力画面です
  -read.php         チャートの表示・写真の表示をする画面です。
  

操作手順：
①input.php「体重入力画面」・・・日付、体重、体脂肪、メモを入力し"submit"ボタンを押下。その後"写真撮る画面へ"を押下します。
　 1.1 creat.phpで上記で入力した値をDBに詰めています。
②form.html「写真撮影画面」・・・写真を取り一旦ローカルに保存し、保存した写真を選択しサーバーへ送信し画面遷移します（本当はcannvasに映った写真を直接サーバーに送りたかったです。。）
  2.1 camera.jsを呼び出しています。このクラス？ではシャッターボタン押下でcanvasに画像表示。ダウンロードボタン押下でローカルに保存する動作が含まれています
③read.php「体重チャート表示・写真表示画面」・・・ここでは、①で入力した値をchart.jsに渡て表示・②で撮った写真の表示をしています。
  3.1 chart.jsには日付・体重・体脂肪をDBから値を取得しグラフ貸しています（メモの実装を忘れている事を記入しながら思い出しました）
  3.2 ②で送信された写真をサーバーに保管し表示させています。
  3.3 getPictures.phpでimageフォルダに入った写真を一覧で表示しています。


以上です、よろしくお願い致します
