<?php 
#######################################################################################
##
#  PHP新着情報、お知らせプログラム ver1.0.1 (2012.08.11更新)
#
#  トップーページの新着情報やお知らせなどに適しています。
#　インラインフレームでも良いですが、トップページに直接埋め込むことでSEOにも効果的です。
#  改造や改変は自己責任で行ってください。
#	
#  今のところ特に問題点はありませんが、不具合等がありましたら下記までご連絡ください。
#  MailAddress: info@php-factory.net
#  name: k.numata
#  HP: http://www.php-factory.net/
##
#######################################################################################
session_start();
header("Content-Type: text/html;charset=UTF-8");

#設定ファイルインクルード
include_once("config.php");

if(isset($_GET['logout'])){
$_SESSION = array();
# セッションを破棄
session_destroy();
}
$error = '';
# セッション変数を初期化
if (!isset($_SESSION['auth'])) {
  $_SESSION['auth'] = FALSE;
}
if (isset($_POST['userid']) && isset($_POST['password'])){
  foreach ($userid as $key => $value) {
    if ($_POST['userid'] === $userid[$key] &&
        $_POST['password'] === $password[$key]) {
      $oldSid = session_id();
      session_regenerate_id(TRUE);
      if (version_compare(PHP_VERSION, '5.1.0', '<')) {
        $path = session_save_path() != '' ? session_save_path() : '/tmp';
        $oldSessionFile = $path . '/sess_' . $oldSid;
        if (file_exists($oldSessionFile)) {
          unlink($oldSessionFile);
        }
      }
      $_SESSION['auth'] = TRUE;
      if(isset($_SESSION['username'])) {
        $_SESSION['username'] = $username[$key];
      };
      break;
    }
  }
  if ($_SESSION['auth'] === FALSE) {
    $error = '<center><font color="red">ユーザーIDかパスワードに誤りがあります。</font></center>';
  }
}
if ($_SESSION['auth'] !== TRUE) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新着情報、お知らせ管理画面</title>
</head>
<style type="text/css">
#login_form{
	width:500px;	
	margin:25px auto;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0px 7px #aaa;
    font-weight: normal;
    padding: 16px 16px 20px;
	color:#666;
	line-height:1.3;
	font-size:90%;
}
form .input {
    font-size: 20px;
    margin:2px 6px 10px 0;
    padding: 3px;
    width: 97%;
}
input[type="text"], input[type="password"], input[type="file"], input[type="button"], input[type="submit"], input[type="reset"] {
    background-color: #FFFFFF;
    border: 1px solid #999;
}
.button-primary {
    border: 1px solid #000;
    border-radius: 11px;
    cursor: pointer;
    font-size: 18px;
    padding: 3px 10px;
	width:450px;
	height:38px;
}
.Tac{text-align:center}
</style>
<body>
<?php echo $error;?>
 <div id="login_form">

 <p class="Tac">管理画面に入場するにはログインする必要があります。<br />
    ID、パスワードはadmin.php内上部に記載されています。<br />管理者以外の入場は固くお断りします。</p>
<form action="admin.php" method="post">
<label for="userid">ユーザーID</label>
<input class="input" type="text" name="userid" id="userid" value="" style="ime-mode:disabled" />
<label for="password">パスワード</label>      
<input class="input" type="password" name="password" id="password" value="" size="30" />
<p class="Tac">
<input class="button-primary" type="submit" name="login_submit" value="　ログイン　" />
</p>
</form>
</div>
</body>
</html>
<?php
exit();
}
//データ保存用ファイルのパーミッションチェック
if (!is_writable($file_path)){
	@chmod($file_path, 0666);
	if (!is_writable($file_path)){
	$messe= "データ保存用の<strong>{$file_path}</strong>が書き込みできません。<strong>{$file_path}</strong>のパーミッションを「666」等書き込み可能なものに変更し、パーミッションチェックしてみてください。<a href=\"admin.php?check=permission\">[パーミッションチェック⇒]</a>";
	}
}else{
	if(isset($_GET['check'])) {
		if($_GET['check']=='permission') $messe= "{$file_path}のパーミッションOK！投稿してみてください。<a href=\"admin.php\">これを非表示にする</a>";
		}
	}
//書き込み・編集処理
if (isset($_POST['submit']) or isset($_POST['edit_submit'])){
  if(empty($_POST['title'])){
		$messe= "タイトルが空です";
  }else{
  $up_ymd=$_POST['year'].'/'.$_POST['month'].'/'.$_POST['day'];
  if(isset($_POST['comment'])){
  $comment = str_replace("\n","<br />",$_POST['comment']);
  $comment = str_replace("\r","","$comment");
  $comment = str_replace(",","","$comment");
  }
  $title=str_replace(",","",$_POST['title']);
  $lines = file("$file_path");
  //$id = uniqid();
  $id = date("YmdHis");//各記事にユニークなIDを付与　現在は年月日時分秒
  if (isset($_POST['edit_submit'])){$id=$_POST['id'];}
  $fp = @fopen("$file_path", "w") or die("fopen Error!!DESUYO--!!!");
  $news_data = $id  . "," .$up_ymd. "," .$title  ."," .$comment  . "\n";
    // 俳他的ロック
    if (flock($fp, LOCK_EX)) {
        // 書き込み
        if (isset($_POST['submit'])){
		fwrite($fp, $news_data);
		$max_line --;
		$messe= "【".$title."】を登録しました";
		}
        if ($max_line!='' and count($lines) > $max_line) {
            $max_i = $max_line;
        } else {
            $max_i = count($lines);
        }
        for ($i = 0; $i < $max_i; $i++) {
        if (isset($_POST['edit_submit'])){
			$lines_array[$i] = explode(",",$lines[$i]);
			if($lines_array[$i][0] != $id){
				 fwrite($fp, $lines[$i]);
			}else{
				fwrite($fp, $news_data);
				$messe= "編集処理完了しました！ ";
			}
		}else{			
            fwrite($fp, $lines[$i]);
		}
    }
  }@fclose($fp);
  
    if($backup_copy=='1' && !isset($_POST['edit_submit'])){
		$backup_file_name = 'data/'.'Backup_'.date('YmdHis') .'.dat';
		if(!@copy($file_path,$backup_file_name)){
			$messe= "バックアップコピー失敗！<strong>data</strong>ディレクトリを書き込み可能なパーミッション（パーミッション707 or 777等）に変更し、ページを更新して再度投稿してみてください。config.phpにてバックアップを無効にすることもできます。<a href=\"admin.php\">[ページを更新する⇒]</a>";
		}else{
			@chmod($backup_file_name, 0666);
			
		}
	}
  }
}
//再表示処理 非表示処理
     $mode=htmlspecialchars(@$_GET['mode']);
	if($mode=='disp' or $mode=='no_disp'){
	 $id=$_GET['id'];
	$lines = file("$file_path");
	$fp = @fopen("$file_path", "w") or die("Error!!n");
    if (flock($fp, LOCK_EX)) {
        if ($max_line!='' and count($lines) > $max_line) {
            $max_i = $max_line;
        } else {
            $max_i = count($lines);
        }
        for ($i = 0; $i < $max_i; $i++) {
			
			$lines_array[$i] = explode(",",$lines[$i]);
			
			if($lines_array[$i][0]!= $id){
				 fwrite($fp, $lines[$i]);
			}else{
				if($mode=='disp'){//表示処理
				$lines[$i] = str_replace("no_disp","","$lines[$i]");
				$messe= "表示処理完了しました！ ";
				}else if($mode=='no_disp'){//非表示処理
				$messe= "非表示処理完了しました！ ";
				$lines[$i] ="no_disp".$lines[$i];
				}
			 fwrite($fp, $lines[$i]);
			}
        }
    }
  @fclose($fp);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex,nofollow" />
<title>新着情報 管理画面</title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">
function yes_no(){
    res = confirm("この記事を削除します！本当にいいですか？！OKなら「OK」を押して「変更」ボタンを押してください");
    if(res == true){
<?php
	if(isset($_POST['del'])){
	$id=$_POST['id'];
	$lines = file("$file_path");
	$fp = @fopen("$file_path", "w") or die("Error!!n");
    if (flock($fp, LOCK_EX)) {
        if ($max_line!='' and count($lines) > $max_line) {
            $max_i = $max_line;
        } else {
            $max_i = count($lines);
        }
        for ($i = 0; $i < $max_i; $i++) {
			
			$lines_array[$i] = explode(",",$lines[$i]);
			
			if($lines_array[$i][0] != $id){
				 fwrite($fp, $lines[$i]);
			}else{
				$lines[$i] = '';
				fwrite($fp, $lines[$i]);
			}
        }
    }
  @fclose($fp);
  $messe= "指定行削除完了しました！ ";
}
?>
   } else{
        alert("キャンセルしました（汗");
		return false;
	}
}

function check(){
	if(document.news_form.title.value == ""){
		window.alert('タイトルを入力してください');
		return false;
	}
	else{
		return true;
	}
}
</script>
<script type="text/javascript">
function openwin(url) {
 wn = window.open(url, 'win','width=520,height=500,status=no,location=no,scrollbars=yes,directories=no,menubar=no,resizable=no,toolbar=no,left=50,top=50');wn.focus();
}
</script>
</head>
<body id="news_admin">
<div id="wrapper">
  <p class="fc_red message_com"><?php if(isset($messe) && $messe_manage == '1')echo "$messe"; ?></p>
  <div class="logout_btn"><a href="?logout=true">ログアウト</a></div>
  <h1>新着情報 管理画面</h1>
  <p>※並び順は日付順です。日付が同じ場合、新しいものは上になります。</p>
<?php 
$lines = file("$file_path");
$lines = newsListSort($lines);

$total = count($lines);
echo <<<EOF
<p align="right">[ 登録数：{$total} ]</p>
EOF;
?>
<div id="news_wrap">
<ul id="news_list">
<?php 
	 $max_i = count($lines);
	 for ($i = 0; $i < $max_i; $i++){
	 $lines_array[$i] = explode(",",$lines[$i]);
	 $id=$lines_array[$i][0];
	 $lines_array[$i][3]=str_replace("\n","",$lines_array[$i][3]);
	 $lines_array[$i][2] = htmlspecialchars($lines_array[$i][2]);
		if(empty($lines_array[$i][3])){
		$title=	$lines_array[$i][2];
		//詳細にURLだけを記述した場合はそのURLに直接リンクする
		}else if ($page_link == 1 && @preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $lines_array[$i][3]) ) {
		$title=	"<a href=\"{$lines_array[$i][3]}\" target=\"_parent\">".$lines_array[$i][2]."</a>";
		}
		else{
		$title="<a href=\"javascript:openwin('popup.php?id={$id}')\">".$lines_array[$i][2]."</a>";
		}
	if($lines[$i]==strpos($lines[$i], 'no_disp')){
	echo"<li class=\"fc_bbb\"><span style=\"color:red;\">非表示中</span> {$lines_array[$i][1]} {$title}  ｜<a href=\"?mode=disp&id={$id}\">[表示する]</a> ｜<a href=\"?mode=edit&id={$id}\">[編集・削除]</a></li>\n";
	 }else{
	echo"<li>{$lines_array[$i][1]}  {$title}  ｜<a href=\"?mode=no_disp&id={$id}\">[非表示にする]</a>｜<a href=\"?mode=edit&id={$id}\">[編集・削除]</a></li>\n";
	 }
} 
?>
</ul>
</div>
<br />
  <h2>記事登録・編集フォーム</h2>

<form method="post" action="admin.php" enctype="multipart/form-data" style="margin:0;" name="news_form" onsubmit="return check()">
<?php
   $mode=htmlspecialchars(@$_GET['mode']);
if($mode=='edit'){
	$id=$_GET['id'];
    $lines = file("$file_path");
        if ($max_line!='' and count($lines) > $max_line) {
            $max_i = $max_line;
        } else {
            $max_i = count($lines);
        }
 for ($i = 0; $i < $max_i; $i++){
	 $lines_array[$i] = explode(",",$lines[$i]);
	 if($lines_array[$i][0]==$id){
		$lines_array[$i][3] = str_replace("<br />","\n","{$lines_array[$i][3]}");
		$lines_array[$i][3] = rtrim("{$lines_array[$i][3]}","\n");
		
	   // $lines_array[$i][3] = str_replace("\r","","{$lines_array[$i][3]}");
	echo"<p style=\"color:red;font-size:18px;\">下記内容を編集後「変更」ボタンを押してください。<a href=\"admin.php\">編集をキャンセル⇒</a></p>";
?>
<p>■タイトル<br />
<?php
	echo"<input type=\"text\" size=\"100\" name=\"title\" value=\"{$lines_array[$i][2]}\" /><br />";
	echo"<input type=\"hidden\" name=\"id\" value=\"{$id}\" />";
	
	$up_ymd_array[$i] = explode("/",$lines_array[$i][1]);
	 
echo <<<EOM
<p>■日付：<input type="text" name="year" size="5" maxlength="4" value="{$up_ymd_array[$i][0]}" /> 年 <input type="text" name="month" size="3" maxlength="2" value="{$up_ymd_array[$i][1]}" /> 月 <input type="text" name="day" size="3" maxlength="2" value="{$up_ymd_array[$i][2]}" /> 日　※並び順にも使用します</p>
EOM;
	//echo"<input type=\"hidden\" name=\"up_ymd\" value=\"{$lines_array[$i][1]}\" />";	
	echo"<p>■詳細があればこちらに記述してください。記述すれば自動的にこちらへのリンク（ポップアップ）が張られます。<br />
・タグは使用不可ですが、URL、及びメルアドを記述すれば自動でリンク設定されます。<br />
・特定のページに直接リンクさせたい場合はhttpから始まるURLのみを記述します。
<font color=red>その場合、URL以外（改行、空白含む）は含めないでください。</font>
<br />";
	echo"<textarea rows=\"12\" cols=\"80\" name=\"comment\" style=\"ime-mode:active\">{$lines_array[$i][3]}</textarea></p>";
	echo"<p>■削除チェック　<input type=\"checkbox\" name=\"del\" value=\"true\" onclick=\"return yes_no()\" /> <span style=\"font-size:13px;color:#666\">※削除する場合はこちらにチェックを入れて「変更」ボタンを押してください。データの復元は不可能ですのでご注意ください。</p>";
	echo"<input type=\"submit\" class=\"submit_btn\" name=\"edit_submit\" value=\"　変更、または削除　\" />";
break;	 }
	}
}else{
?>
<p>■タイトル：<input type="text" size="80" name="title" /></p>

<p>■日付：<input type="text" name="year" size="5" maxlength="4" value="<?php echo date("Y",time());?>" /> 年 <input type="text" name="month" size="3" maxlength="2" value="<?php echo date("m",time());?>" /> 月 <input type="text" name="day" size="3" maxlength="2" value="<?php echo date("d",time());?>" /> 日　※並び順にも使用します</p>

<p>■詳細があればこちらに記述してください。記述すれば自動的にこちらへのリンク（ポップアップ）が張られます。<br />
・タグは使用不可ですが、URL、及びメルアドを記述すれば自動でリンク設定されます。<br />
・特定のページに直接リンクさせたい場合はhttpから始まるURLのみを記述します。
<font color=red>その場合、URL以外（改行、空白含む）は含めないでください。</font>
<br />

<textarea rows="12" cols="80" name="comment" style="ime-mode:active" id="comment"></textarea></p>
<input type="submit" class="submit_btn" name="submit" value="　新規登録　" />
<?php
}
?>
</form>
<br />
<br />
<!-- 以下必要なければ削除可能です-->
<h2 style="font-size:14px;">更新履歴（不具合情報やバージョンアップ情報などがあればこちらに表示されます）</h2>
<iframe src="http://www.kens-web.com/php/news/" width="98%" height="100" title="news" frameborder="0" scrolling="auto"></iframe>
<?php if($copyright) echo $copyright ?>


<?php
if (isset($_POST['submit']) && $backup_copy == 1){
//ディレクトリ・ハンドルをオープン
$res_dir = @opendir( 'data' );
$main_file = 'news.dat';
//ディレクトリ内のファイル名を取得
while( $file_name = @readdir( $res_dir ) ){
	//取得したファイル名を表示
	$file_name2 = str_replace(array('Backup_','.dat'),'',$file_name);
	//指定日以前のファイルを削除
	if($file_name2 < date("YmdHis",strtotime("-{$del_month} month")) && $file_name != $main_file){
			@unlink("data/{$file_name}");
	}
	//print "{$file_name}<br>\n";
}
closedir( $res_dir );
}
?>
</div>
</body>
</html>