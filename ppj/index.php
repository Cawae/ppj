<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>共通CSS</title>
		<link rel="stylesheet" href="./css/common.css" type="text/css">
		<link rel="stylesheet" href="./css/jquery.bxslider.css" type="text/css">
		<title></title>
		<script type="text/javascript" src="./js/jquery.js" ></script>
		<script type="text/javascript" src="./js/jquery.easing.1.3.js" ></script>
		<script type="text/javascript" src="./js/jquery.bxslider.min.js" ></script>
		<script type="text/javascript">
		<!--自動スライドタイプ-->
		<!--
			$(document).ready(function(){
				$('#slider1').bxSlider({
					auto: true, //自動スライド
					speed: 1500, //スライド時間
					pause: 6000, //停止時間
				});
			});
		-->
		<!--
			function openwin(url) {//PC用ポップアップ。ウインドウの幅、高さなど自由に編集できます
			 wn = window.open(url, 'win','width=520,height=500,status=no,location=no,scrollbars=yes,directories=no,menubar=no,resizable=no,toolbar=no');wn.focus();
			}
		-->
		</script>
	</head>

	<body>

		<div id="wrap">

			<!-- ヘッダー部分 -->
			<div id="header">
				<h1><img src="./img/hd_title.png" alt="ピーピージェイ株式会社"></h1>
				<div id="hd_menu">
					<p><a href="./index.php"><img src="./img/hd_logo.png" alt="PPJロゴ"></a></p>
					<ul>
						<li><a href="./lease.html">物件紹介</a></li>
						<li><img src="./img/hd_boundary.png" alt="*"></li>
						<li><a href="./overview.html">会社概要</a></li>
						<li><img src="./img/hd_boundary.png" alt="*"></li>
						<li><a href="./contact.php">お問い合わせ</a></li>
					</ul>
				</div>
			</div>



			<!-- 画像部分-->
		<div id="slider1">
			<div><a href="lease_yutaka.php"><img src="./img/top_yutaka.jpg" alt="*"></a></div>
			<div><a href="lease_hanakawa.php"><img src="./img/top_hanakawa.jpg" alt="*"></a></div>
			<div><a href="lease_my2.php"><img src="./img/top_my2.jpg" alt="*"></a></div>
		</div>



			<!--新着情報部分-->
			<div id="news_wrap">
<ul id="news_list">
<?php 
//設定ファイルインクルード
include_once("news/config.php");
//データファイル（news.dat）のパス
$file_path = 'news/data/news.dat'; 
//ファイルの内容を取得　表示
$lines = file("$file_path");
$lines = newsListSort($lines);
$count = 0;
foreach($lines as $val){
if($count >= $news_dsp_count) break;
	$lines_array = explode(",",$val);
	$lines_array[3]=str_replace("\n","",$lines_array[3]);
	if($val!=strpos($val, 'no_disp')){
	$lines_array[2] = htmlspecialchars($lines_array[2]);
	if($encodingType!='UTF-8') $lines_array[2] = mb_convert_encoding($lines_array[2],"$encodingType",'UTF-8');//UTF-8以外であれば文字コード変更
		if(empty($lines_array[3])){
		$title=	$lines_array[2];
		//詳細にURLだけを記述した場合はそのURLに直接リンクする
		}else if ($page_link == 1 && @preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/', $lines_array[3]) ) {
		$title=	"<a href=\"{$lines_array[3]}\" target=\"_parent\">".$lines_array[2]."</a>";
		}else{
if(is_sp()){//スマホの場合のリンクタグ（変更可）
$title= <<<EOF
<a href="news/popup.php?id={$lines_array[0]}" title="{$lines_array[2]}" target="_blank">$lines_array[2]</a>
EOF;
}else if(is_mb()){//携帯の場合のリンクタグ（変更可）
$title= <<<EOF
<a href="news/popup.php?id={$lines_array[0]}" title="{$lines_array[2]}" target="_blank">$lines_array[2]</a>
EOF;
}else{//携帯、スマホ以外のリンクタグ（PC）（変更可）
$title= <<<EOF
<a href="javascript:openwin('news/popup.php?id={$lines_array[0]}')" title="{$lines_array[2]}">$lines_array[2]</a>
EOF;
}
			}
echo <<<EOF
<li><span class="news_List_Ymd">{$lines_array[1]} </span> <span class="news_List_Title">{$title} </span></li>
EOF;
$count++;
	}
}	
?>
</ul>
<?php if($copyright) echo $copyright ?>
			</div>



			<!-- フッター部分 -->
			<div id="footer">
				<ul>
					<li><p><img src="./img/ft_tell.png" alt="06-6877-6262"></p></li>
					<li><p><img src="./img/ft_facebook.png" alt="フェイスブック"></p></li>
					<li><p><img src="./img/ft_twitter.png" alt="ツイッター"></p></li>
					<li><p><a href="./privacy.html"><img src="./img/ft_privacy.png" alt="プライバシーポリシー"></a></p></li>
					<li><p><a href="./sitemap.html"><img src="./img/ft_sitemap.png" alt="サイトマップ"></a></p></li>
					<li><p><a href="./contact.php">お問い合わせ</a></p></li>
				</ul>
				<p><img src="./img/ft_copy.png" alt="Copyright&nbsp;&copy;&nbsp;2013&nbsp;Co.,Ltd.&nbsp;All&nbsp;Rights&nbsp;Reserved."></p>
			</div>


		</div>

	</body>

</html>