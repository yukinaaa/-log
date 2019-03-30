<html>
	<head>
		<title>mission_1-6.php</title>
		<meta charset="utf-8">
	</head>
<body>
	<form method="POST"action="mission_1-6.php">
	<input type="text"name="data"value="コメント">
	<input type="submit"value="送信">
</form>
<?php
	$data=$_POST["data"];
	if(empty($_POST["data"]))
	{echo'入力されていません';}
	else{echo $data.'を受け付けました';
 	$filename="mission_1-6.txt";
	$fp=fopen($filename,'a');//追記モードで開く
	fwrite($fp,$line.$data.PHP_EOL);
	fclose($fp);}
?>
		
	</body>
</html>