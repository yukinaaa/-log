<html>
	<head>
		<title>mission_1-5-2</title>
		<meta charset="utf-8">
			</head>
<body>
<form method="POST"action="mission_1-5-2.php">
	<input type="text"name="data"value="コメント">
	<input type="submit"value="送信">
</form>
	<?php
	$data=$_POST["data"];
	if(empty($_POST["data"]))
	{echo'入力されていません';}
	elseif($data=='完成！')
	{echo'おめでとう！';
	$filename="mission_1-5-1.txt";
	$fp=fopen($filename,'w');
	fwrite($fp,$data);
	fclose($fp);}
	else{echo $data.'を受け付けました';
 	$filename="mission_1-5-1.txt";
	$fp=fopen($filename,'w');
	fwrite($fp,$data);
	fclose($fp);}
?>



</body>
</html>