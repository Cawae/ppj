<?php
//設定ファイルインクルード
include_once("config.php");
	$id=$_GET['id'];
    $lines = file("$file_path");
	$lines = newsListSort($lines);
    $max_i = count($lines);
     for ($i = 0; $i < $max_i; $i++){
	 $lines_array[$i] = explode(",",$lines[$i]);
	 if($lines_array[$i][0]==$id){
		 
	$lines_array[$i][2] = htmlspecialchars($lines_array[$i][2]);
	$lines_array[$i][3] = htmlspecialchars($lines_array[$i][3]);
	$lines_array[$i][3] = str_replace("&lt;br /&gt;","<br />",$lines_array[$i][3]);
	
    //自動リンク設定
	$lines_array[$i][3] = preg_replace("'/[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]'","<a href=\"\\0\" target=\"_blank\">\\0</a>", $lines_array[$i][3]);
	
	//メールアドレス時、mailto設定
    $lines_array[$i][3] = preg_replace("([0-9A-Za-z\.\/\~\-\+\:\;\?\=\&\%\#\_]+@[-0-9A-Za-z\.\/\~\-\+\:\;\?\=\&\%\#\_]+)","[<a href=\"mailto:\\1\">MAIL</a>]", $lines_array[$i][3]);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php	echo"{$lines_array[$i][2]}";?></title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<?php
if(is_sp()){//スマホの場合の表記
echo<<<EOF
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
EOF;
}
?>
</head>
<body id="news_popup">
<?php
echo <<<EOF

<h2>{$lines_array[$i][2]}</h2>
<p class="up_ymd">{$lines_array[$i][1]}</p>
<p id="cbox">{$lines_array[$i][3]}</p>

EOF;
break;
		}
	}
?>
<p class="close_btn"><a href="javascript:window.close();">CLOSE</a></p>
</body>
</html>