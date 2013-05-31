<?php
//配列初期化
$userid=array();
$password=array();
#######################################################################################
##
#  PHP新着情報、お知らせプログラム　ver1.0.1 (2012.08.11更新)
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


##### ▼必須設定項目▼ #####

//■管理画面ログイン用パスワード　※必ず変更してください。
$userid[]   = 'admin';   // ユーザーID
$password[] = '1397';   // パスワード

//ニュースタイトル一覧を設置するページの文字コード。(埋め込み版でのみ使用)
//埋め込みするページの文字コードがUTF-8以外の場合は指定してください。
//Shift-jisは「SJIS」、EUC-JPは「EUC-JP」と指定してください。デフォルトはUTF-8。
$encodingType = 'UTF-8';
#####▲ 必須設定項目 ▲#####


####▼ 任意設定（必要に応じて設定してください） ▼#####

//■登録可能数上限　この値を超えた場合、古いものから消えていきます。負荷を考慮し、ある程度上限を設けていたほうが無難です。無制限にもできますが。
$max_line = 500;
//■無制限にする場合は下記のコメント「//」（スラッシュ2つ）を外して（有効化）ください。
//$max_line = ''; 

//■表示件数（ニュースの表示数）※現実的に100件も表示させる意味は無い気が・・。管理画面は全件表示されます
$news_dsp_count = 100;

//■データファイルのパス（そのまま使う場合特に変更の必要なし）
$file_path = 'data/news.dat';

//■管理画面で編集や投稿時にページ上部にメッセージ（更新しました！等）を表示する（0=しない、1=する）※パーミッション未設定時にも表示されるので初めは表示にしててください
$messe_manage = 1;

//■バックアップファイルを作成する（0=しない、1=する）※新規投稿時に「Backup_日時分秒.dat」のファイル名で保存される。古いものは自動で削除します。下記で期間指定。
//ファイル自体はそれほど大きくはありませんが、サーバー容量に不安がある場合は「しない」にしてください。
$backup_copy = 0;

//■バックアップファイルを何ヶ月前まで保存するか（月を1～12で指定。デフォルトは3ヶ月前までを保存）※上記で「1」を指定した場合のみ
$del_month = 3;

//■詳細にURLだけを記述した場合はそのURLに直接リンクする（0=しない、1=する）
//※特定のページに飛ばしたいだけの場合に便利。詳細がURLだけの場合のみ設定されます。
$page_link = 1;

#####▲ 任意設定終了 ▲#####



#####▼ 関数定義（基本的には変更しないでください）▼#####

//携帯判定関数
function is_mb() {
$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match("/^DoCoMo/i", $ua) || !preg_match("/^(J\-PHONE|Vodafone|MOT\-[CV]|SoftBank)/i", $ua) || !preg_match("/^KDDI\-/i", $ua) || !preg_match("/UP\.Browser/i", $ua) || !preg_match("^UP.Browser|^KDDI", $ua) || !preg_match("WILLCOM",$ua)){
	return true;
}
	return false;
}
//スマホ判定関数
function is_sp() {
$useragents = array(
'iPhone', // Apple iPhone
'iPod', // Apple iPod touch
'Android', // 1.5+ Android
'dream', // Pre 1.5 Android
'CUPCAKE', // 1.5+ Android
'blackberry9500', // Storm
'blackberry9530', // Storm
'blackberry9520', // Storm v2
'blackberry9550', // Storm v2
'blackberry9800', // Torch
'webOS', // Palm Pre Experimental
'incognito', // Other iPhone browser
'webmate' // Other iPhone browser
);
$pattern = '/'.implode('|', $useragents).'/i';
return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
//ニュースリストの並び順（日付順）用関数
function newsListSort($lines){
	$jj = 0;
	$index=array();
	$index2=array();
	foreach($lines as $val){
	$lines_array = explode(",",$val);
	$index[] = strtotime($lines_array[1]);
	$index2[] = $jj++;
	}
	@array_multisort($index,SORT_DESC,SORT_NUMERIC,$index2,SORT_ASC,SORT_NUMERIC,$lines);
	return $lines;
}

//著作権表示
$copyright = <<<EOF
<div style="text-align:center;margin-top:25px;font-size:12px;color:#999">Powerd by - <a style="font-size:12px;text-decoration:none;color:#999" href="http://www.php-factory.net/" target="_blank">PHP工房</a> -</div>
EOF;
