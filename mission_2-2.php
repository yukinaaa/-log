<html>
	<head>
		<title>mission_2-2.php</title>
		<meta charset="utf-8">
	</head>
<body>
	<form method="POST"action="mission_2-2.php">
	名前：<input type="text"name="name"value><br/>
	コメント：<input type="text"name="comment"value><br/>
	<input type="submit"value="送信">
</form>
<?php
	$filename="mission_2-1.txt";
	$count=count(file($filename))+1;
	$name=$_POST["name"];
	$comment=$_POST["comment"];
date_default_timezone_set('Asia/Tokyo');//時間を表示する地域の設定
	$date=date("Y年m月d日H:i:s");//現在時刻
	$lines=$count."<>".$name."<>".$comment."<>".$date;
	if(empty($_POST["name"])&&empty($_POST["comment"]))
	{echo'入力されていません';}
		else{$fp=fopen($filename,'a');
		fwrite($fp,$lines.PHP_EOL);
		fclose($fp);//追記モードで開く
		$lines=file($filename);//ファイルを配列として読み込む
		foreach($lines as $line){
		$newline=explode("<>",$line);//1行ずつの配列を＜＞で分割、分割したものを繰り返し処理
		echo $newline[0]." ".$newline[1]." ".$newline[2]." ".$newline[3]."<br/>";}}//分割したものを繋げて表示
?>
		
	</body>
</html>