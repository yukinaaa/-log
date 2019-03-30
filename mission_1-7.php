<html>
	<head>
		<title>mission_1-7.php</title>
		<meta charset="utf-8">
	</head>
<body>
	<form method="POST"action="mission_1-7.php">
	<input type="text"name="data"value="コメント">
	<input type="submit"value="送信">
</form>
<?php
	$data=$_POST["data"];
	if(empty($_POST["data"]))
	{echo'入力されていません';}
	else{echo $data."<br/>";
	$data=@file("mission_1-6.txt");
	foreach($data as $line)
	{echo $line."<br/>\n";}}
?>
		
	</body>
</html>