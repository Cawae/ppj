<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>PPJ空室情報テスト送信</title>
	</head>

	<body>
		<h1>空室情報更新管理画面</h1>
		<form action="./form.php" method="post">
			<h2>ロイヤルユタカ</h2>
			<p><input name="vacant01" type="radio" value="0" checked>空室あり</p>
			<p><input name="vacant01" type="radio" value="1">空室なし</p>
			<p><input type="submit" onclick="check()">
			<?php
				$img_vacant = '<img src="./img/vacant.png" alt="空室あり">';
				$img_fully = '<img src="./img/fully.png" alt="空室なし">';
				$savefile = "yutaka.txt";
				if(isset($_POST['vacant01'])) {
					if($_POST['vacant01'] == 0) {
						file_put_contents($savefile, "$img_vacant");
					}
					else if($_POST['vacant01'] == 1) {
						file_put_contents($savefile, "$img_fully");
					};
				};
				if(file_get_contents($savefile) == $img_vacant) {
					echo '空室あり';
				}
				else if(file_get_contents($savefile) == $img_fully) {
					echo '空室なし';
				}
			?>
		</form>

		<form action="./form.php" method="post">
			<h2>MY2レジデンス</h2>
			<p><input name="vacant02" type="radio" value="0" checked>空室あり</p>
			<p><input name="vacant02" type="radio" value="1">空室なし</p>
			<p><input type="submit">
			<?php
				$img_vacant = '<img src="./img/vacant.png" alt="空室あり">';
				$img_fully = '<img src="./img/fully.png" alt="空室なし">';
				$savefile = "my2.txt";
				if(isset($_POST['vacant02'])) {
					if($_POST['vacant02'] == 0) {
						file_put_contents($savefile, "$img_vacant");
					}
					else if($_POST['vacant02'] == 1) {
						file_put_contents($savefile, "$img_fully");
					};
				};
				if(file_get_contents($savefile) == $img_vacant) {
					echo '空室あり';
				}
				else if(file_get_contents($savefile) == $img_fully) {
					echo '空室なし';
				}
			?>
		</form>

		<form action="./form.php" method="post">
			<h2>モータープール花川</h2>
			<p><input name="vacant03" type="radio" value="0" checked>空車あり</p>
			<p><input name="vacant03" type="radio" value="1">空車なし</p>
			<p><input type="submit">
			<?php
				$img_empty = '<img src="./img/empty.png" alt="空車あり">';
				$img_full = '<img src="./img/full.png" alt="空車なし">';
				$savefile = "hanakawa.txt";
				if(isset($_POST['vacant03'])) {
					if($_POST['vacant03'] == 0) {
						file_put_contents($savefile, "$img_empty");
					}
					else if($_POST['vacant03'] == 1) {
						file_put_contents($savefile, "$img_full");
					};
				};
				if(file_get_contents($savefile) == $img_empty) {
					echo '空車あり';
				}
				else if(file_get_contents($savefile) == $img_full) {
					echo '空車なし';
				}
			?>
		</form>
	</body>

</html>