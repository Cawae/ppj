<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<title>モータープール花川</title>
		<link rel="stylesheet" href="./css/common.css" type="text/css">
		<link rel="stylesheet" href="./css/pagetop.css" type="text/css">
		<link rel="stylesheet" href="./css/lease_contents_common.css" type="text/css">
		<link rel="stylesheet" href="./css/detail_text_hanakawa.css" type="text/css">
		<link rel="stylesheet" href="css/lightbox.css" type="text/css">
		<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script src="./js/google_maps_hanakawa.js" type="text/javascript"></script>
		<script src="js/prototype.js" type="text/javascript"></script>  
		<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script> 
		<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="js/lightbox.js" type="text/javascript"></script>

	</head>

	<body id="TOP" onload="initialize()">

		<!-- モータープール花川紹介ページ -->
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



			<div id="contents">

				<!-- メイン紹介ページ -->
				<div id="main">
					<div id="photo">
						<h2><img src="./img/title_hanakawa.png" alt="モータープール花川"></h2>
						<p>
							<?php
								echo file_get_contents('./news/data/hanakawa.dat');
							?>
						</p>
						<p><img src="./img/main_hanakawa.jpg" alt="ロイヤルユタカの写真"></p>
					</div>

					<div id="plan">
						<p><img src="./img/plan_hanakawa.png" alt="ロイヤルユタカの見取り図"></p>
					</div>

					<div id="s_photo">
						<ul>
							<li><p><a href="./img/hanakawa01.jpg" rel="lightbox[roadtrip]"><img src="./img/s_hanakawa01.jpg" alt="サムネイル1"></a></p></li>
							<li><p><a href="./img/hanakawa02.jpg" rel="lightbox[roadtrip]"><img src="./img/s_hanakawa02.jpg" alt="サムネイル2"></a></p></li>
							<li><p><img src="./img/s_hanakawa03.png" alt="サムネイル3"></p></li>
							<li><p><img src="./img/s_hanakawa03.png" alt="サムネイル4"></p></li>
							<li><p><img src="./img/s_hanakawa03.png" alt="サムネイル5"></p></li>
							<li><p><img src="./img/s_hanakawa03.png" alt="サムネイル6"></p></li>
						</ul>
						<p>『モータープール花川』は『ロイヤルユタカ』に隣接しております。<br>全区画屋根付き・夜間照明付きで車にもお客様にも安心で安全です。空き情報に関してはおいがるにお問い合わせください。</p>
					</div>
				</div>

				<!-- 詳細紹介ページ -->
				<div id="detail">
					<h2><img src="./img/detail.png" alt="物件詳細"></h2>
					<p>大阪市西淀川区花川2-21-20<br>阪神本線&nbsp;姫島駅より徒歩約10分<br>JR神戸線&nbsp;塚本駅より徒歩約15分</p>



					<!-- Google Maps API -->
					<div id="map_canvas">
					</div>



					<!-- 物件詳細 -->
					<div id="text">
						<dl>
							<dt>物件名</dt>
								<dd>モータープール花川</dd>
							<dt>賃料</dt>
								<dd class="center">&#8212;</dd>
							<dt>専有面積</dt>
								<dd class="center">&#8212;</dd>
							<dt>間取り</dt>
								<dd class="center">&#8212;</dd>
							<dt>種別/構造</dt>
								<dd>鉄骨造</dd>
							<dt>竣工年</dt>
								<dd>1994年2月</dd>
							<dt>設備/条件</dt>
								<dd>屋根付き<br>
								照明付き</dd>
							<dt>周辺情報</dt>
								<dd>ロイヤルユタカ隣接</dd>
						</dl>
					</div>

				</div>



			</div>



			<!-- ページトップへ戻る -->
			<div id="pagetop">
				<p><a href="#TOP"><img src="./img/pagetop.png" alt="ページトップへ"></a></p>
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