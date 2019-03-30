

<?php
#初期設定
    $filename = "mission_2-1.txt";
    $count = count(file($filename))+1);//投稿番号
	$name = $_POST["name"];//名前
	$comment = $_POST["comment"];//コメント
    $delete = $_POST["delete"];//削除
	$numberecho = $_POST["numberecho"];//編集する番号の表示
    date_default_timezone_set('Asia/Tokyo');//時間を表示する地域の設定
	$date = date("Y年m月d日H:i:s");//現在時刻

#新規投稿フォーマット
	$lines = $count."<>".$name."<>".$comment."<>".$date;//投稿番号、名前、コメント、日時を繋げたもの


#編集する投稿内容取得
if(!empty($_POST["edit"])){//編集番号が入力されているとき
    $edit = $_POST["edit"];//編集番号
	$lines=file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);//ファイルを配列として読み込む。その際改行文字は含まない。
	foreach($lines as $line){
        $newline = explode("<>",$line);//1行ずつの配列を＜＞で分割//分割したものを繰り返し処理
	   if($edit == $newline[0])//編集番号と投稿番号が一致したとき
	   {
           $editname = $newline[1];
	       $editcomment = $newline[2];
       }
    }//名前とコメントを代入
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>mission_2-4.php</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="POST" action="mission_2-4.php">
        　　　　名前：<input type="text" name="name" value="<?php echo $editname?>" placeholder="名前"><br>
        　　コメント：<input type="text" name="comment" value="<?php echo $editcomment?>" placeholder="コメント">
        <input type="submit" value="送信"><br><br>
        削除対象番号：<input type="text" name="delete" value="" placeholder="削除対象番号">
        <input type="submit" value="削除"><br><br>
        編集対象番号：<input type="text" name="edit" value="" placeholder="編集対象番号">
        <input type="submit" value="編集"><br>

        　<!--編集用-->
	<input type="hidden" name="numberecho" value="<?php echo $edit?>">
        <input type="hidden" name="submit" value="送信">

    </form>
</body>
</html>
    
<?php
    
#新規投稿機能(2-1)
	if(!empty($_POST["name"])&&!empty($_POST["comment"])&&empty($_POST["numberecho"])){
        $fp=fopen($filename,'a');//追記モードで開く
        fwrite($fp,$lines.PHP_EOL);
        fclose($fp);
    }

#削除について(2-3)
    if(empty($_POST["name"]) && empty($_POST["comment"]) && !empty($_POST["delete"])){//名前とコメントが空白、かつ削除番号が入力されているとき
        $lines = file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);//ファイルを配列として読み込む。その際改行文字は含まない。
        $fp = fopen($filename,'w');//既存ファイルを空にし、上書きする
        foreach($lines as $line){$newline=explode("<>",$line);//1行ずつの配列を＜＞で分割//分割したものを繰り返し処理
            if($delete !== $newline[0]){//削除番号と投稿番号が一致しないとき
                fwrite($fp,$line.PHP_EOL);
            }
        }//1行ずつの配列を読み込む
        fclose($fp);
    }

#編集について(作業中)

if(!empty($_POST["name"])&&!empty($_POST["comment"]) && !empty($_POST["numberecho"])){//名前、コメント、編集対象番号が入力されているとき
	$file=file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);//ファイルを配列として読み込む。その際改行文字は含まない。
	$fp=fopen($filename,'w');//既存ファイルを空にし、上書きする
	foreach($file as $line){$editdata=explode("<>",$line);//1行ずつの配列を＜＞で分割//分割したものを繰り返し処理←ここまではOK？
		if($numberecho!==$editdata[0]){//編集番号と投稿番号が一致しないとき
	fwrite($fp,$line.PHP_EOL);}
		else if($numberecho==$editdata[0]){//編集番号と投稿番号が一致したとき
	$editdata[0] = $numberecho;
	$editdata[1] = $name;
	$editdata[2] = $comment;//編集したデータを代入
	$editdata=$editdata[0]."<>".$editdata[1]."<>".$editdata[2]."<>".$editdata[3];
		fwrite($fp,$editdata.PHP_EOL);}//編集したデータの書き込み
	}
fclose($fp);}


#表示について(2-2)
    $fp = fopen($filename,'r');//ファイルを読み込みモードで開く
    $lines = file($filename);//ファイルを配列として読み込む
    foreach($lines as $line){
        $newline = explode("<>",$line);//1行ずつの配列を＜＞で分割、分割したものを繰り返し処理
        echo $newline[0]." ".$newline[1]." ".$newline[2]." ".$newline[3]."<br/>";
    }//分割したものを繋げて表示
    fclose($fp);
?>