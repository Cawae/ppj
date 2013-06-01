<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<title>Myレジデンス</title>
		<link rel="stylesheet" href="./css/common.css" type="text/css">
		<link rel="stylesheet" href="./css/pagetop.css" type="text/css">
		<link rel="stylesheet" href="./css/lease_contents_common.css" type="text/css">
		<link rel="stylesheet" href="./css/detail_text_my2.css" type="text/css">
		<link rel="stylesheet" href="css/lightbox.css" type="text/css">
		<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
		<script src="./js/google_maps_my2.js" type="text/javascript"></script>
		<script src="js/prototype.js" type="text/javascript"></script>  
		<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script> 
		<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="js/lightbox.js" type="text/javascript"></script>
	</head>

	<body id="TOP" onload="initialize()">

		<!-- Myレジデンス -->
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
						<h2><img src="./img/title_my2.png" alt="ロイヤルユタカ"></h2>
						<p>
							<?php
								echo file_get_contents('my2.txt');
							?>
						</p>
						<p><img src="./img/main_my2.jpg" alt="ロイヤルユタカの写真"></p>
					</div>

					<div id="plan">
						<p><img src="./img/plan_my2.png" alt="ロイヤルユタカの間取り図"></p>
					</div>

					<div id="s_photo">
						<ul>
							<li><p><a href="./img/my2_01.jpg" rel="lightbox[roadtrip]"><img src="./img/s_my2_01.jpg" alt="サムネイル1"></a></p></li>
							<li><p><a href="./img/my2_02.jpg" rel="lightbox[roadtrip]"><img src="./img/s_my2_02.jpg" alt="サムネイル2"></a></p></li>
							<li><p><a href="./img/my2_03.jpg" rel="lightbox[roadtrip]"><img src="./img/s_my2_03.jpg" alt="サムネイル3"></a></p></li>
							<li><p><a href="./img/my2_04.jpg" rel="lightbox[roadtrip]"><img src="./img/s_my2_04.jpg" alt="サムネイル4"></a></p></li>
							<li><p><a href="./img/my2_05.jpg" rel="lightbox[roadtrip]"><img src="./img/s_my2_05.jpg" alt="サムネイル5"></a></p></li>
							<li><p><img src="./img/s_my2_06.png" alt="サムネイル6"></p></li>
						</ul>
						<p>MY2レジデンスは1フロア1部屋の広々とした間取りと全室ストックヤード付きの抜群の首脳設備を備えつけております。<br>大阪都心3km圏内でキタとミナミに直結しており、駐輪場付きのファミリー向けのお部屋となっております。<br>ビル下に美容院が入店している他、スーパー・学校・公園なども隣接しておりご家族様の生活をサポートいたします。</p>
					</div>
				</div>


				<!-- 詳細紹介ページ -->
				<div id="detail">
					<h2><img src="./img/detail.png" alt="物件詳細"></h2>
					<p>大阪市福島区吉野4-9-11<br>JR環状線・阪神なんば線&nbsp;西九条駅より徒歩約10分<br>JR環状線&nbsp;野田駅より徒歩約10分</p>



					<!-- Google Maps API -->
					<div id="map_canvas">
					</div>



					<div id="text">
						<dl>
							<dt>物件名</dt>
								<dd>MY2レジデンス</dd>
							<dt>賃料</dt>
								<dd>9.8～10万円（管理費込）</dd>
							<dt>礼金</dt>
								<dd>25万円</dd>
							<dt>専有面積</dt>
								<dd>75&#13217;</dd>
							<dt>間取り</dt>
								<dd>3LDK</dd>
							<dt>種別/構造</dt>
								<dd>マンション/鉄骨造</dd>
							<dt>竣工年</dt>
								<dd>1981年4月</dd>
							<dt>設備/条件</dt>
								<dd>フローリング/システムキッチン<br>
								ガスコンロ対応/バストイレ別<br>
								洗面所/洗濯機置場/収納有り<br>
								CATV.BS.光ファイバー対応済/バルコニー<br>
								ペット可（相談）/オートロック/屋内洗濯機置場</dd>
							<dt>周辺情報</dt>
								<dd>福島区役所まで&nbsp;徒歩約15分&nbsp;800m<br>
								吉野町公園まで&nbsp;徒歩約10分&nbsp;500m</dd>
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