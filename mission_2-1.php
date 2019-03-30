<html>
	<head>
		<title>mission_2-1.php</title>
		<meta charset="utf-8">
	</head>
<body>
	<form method="POST"action="mission_2-1.php">
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
	$test=$count."<>".$name."<>".$comment."<>".$date;
	if(empty($_POST["name"])&&empty($_POST["comment"]))
	{echo'入力されていません';}
	else{$fp=fopen($filename,'a');//追記モードで開く
	fwrite($fp,$test.PHP_EOL);
	fclose($fp);}
?>
		
	</body>
</html>