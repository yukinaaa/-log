<html>
	<head>
			<title>mission_2-3.php</title>
		<meta charset="utf-8">
	</head>
<body>
<form method="POST"action="mission_2-3.php">
	名前：<input type="text"name="name"value><br/>
	コメント：<input type="text"name="comment"value>
	<input type="submit"value="送信"><br/>
	<input type="text"name="delete"value="削除対象番号">
	<input type="submit"value="削除">
	
</form>
<?php
$filename="mission_2-1.txt";
	$count=count(file($filename))+1;//投稿番号
	$name=$_POST["name"];//名前
	$comment=$_POST["comment"];//コメント
	$delete=$_POST["delete"];//削除
date_default_timezone_set('Asia/Tokyo');//時間を表示する地域の設定
	$date=date("Y年m月d日H:i:s");//現在時刻
	$lines=$count."<>".$name."<>".$comment."<>".$date;//投稿番号、名前、コメント、日時を繋げたもの

//以下投稿機能(2-1)
	if(!empty($_POST["name"])&&!empty($_POST["comment"]))
	{$fp=fopen($filename,'a');//追記モードで開く
	fwrite($fp,$lines.PHP_EOL);
	fclose($fp);}

//削除について
if(empty($_POST["name"])&&empty($_POST["comment"])&&!empty($_POST["delete"])){//名前とコメントが空白、かつ削除番号が入力されているとき
		$lines=file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);//ファイルを配列として読み込む。その際改行文字は含まない。
		$fp=fopen($filename,'w');//既存ファイルを空にし、上書きする
		foreach($lines as $line){$newline=explode("<>",$line);//1行ずつの配列を＜＞で分割//分割したものを繰り返し処理
		if($delete!==$newline[0])//削除番号と投稿番号が一致しないとき
		{fwrite($fp,$line.PHP_EOL);}}//1行ずつの配列を読み込む
		fclose($fp);}

//表示について(2-2)
$fp=fopen($filename,'r');//ファイルを読み込みモードで開く
	$lines=file($filename);//ファイルを配列として読み込む
	foreach($lines as $line){
	$newline=explode("<>",$line);//1行ずつの配列を＜＞で分割、分割したものを繰り返し処理
	echo $newline[0]." ".$newline[1]." ".$newline[2]." ".$newline[3]."<br/>";}//分割したものを繋げて表示
	fclose($fp);
?>

		
	</body>
</html>