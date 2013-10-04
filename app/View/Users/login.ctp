<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Bridge | login</title>
		<meta name="keywords" content="bridge登録" />
		<meta name="description" content="Register Bridge" />
		<meta name="author" content="shinya" />
		<meta name="copyright" content="Bridge">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="../../webroot/css/cake.generic.css">
		<link rel="stylesheet" href="../../webroot/css/bootstrap.css">
		<link rel="stylesheet" href="../../webroot/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../webroot/css/login.css">
		<script src="../../webroot/js/empty"></script>
		<script type='text/javascript' src='js/jquery.modal.js'></script>
		<script type='text/javascript' src='js/site.js'></script>
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		
		<style>
			body {
				background-image: url("<?php echo $this -> Html -> url('../img/a1180_008305_m.jpg'); ?>");
				background-repeat: no-repeat;
				background-attachment: fixed;
			}
		</style>
		
		

	</head>
	<body>
		<!-- Container -->
		<div id="container">
			<!-- Header -->
			<header id="header">
				<h1>ログイン</h1>
			</header>
			<!-- //Header -->

			<hr />
			<!-- Contents -->
			<div id='modal'>
				<div class='login_form'>
					<?php echo $this -> Session -> flash('auth'); ?>
					
					<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'login')); ?>
						<?php echo $this -> Form -> input('name', array('type' => '', 'label' => 'ユーザーIDまたはメールアドレス')); ?>
						<?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => 'password')); ?>
					<?php echo $this -> Form -> end('ログイン'); ?>
				</div>
			</div>
			
			<script>
				$(function() {
					setModal();
				})
				function setModal() {

					//HTML読み込み時にモーダルウィンドウの位置をセンターに調整
					adjustCenter("div#modal div.container");

					//ウィンドウリサイズ時にモーダルウィンドウの位置をセンターに調整
					$(window).resize(function() {
						adjustCenter("div#modal div.container");
					});

					//背景がクリックされた時にモーダルウィンドウを閉じる
					$("div#modal div.background").click(function() {
						displayModal(false);
					});

					//リンクがクリックされた時にAjaxでコンテンツを読み込む
					$("a.modal").click(function() {
						$("div#modal div.container").load($(this).attr("href"), data = "html", onComplete);
						return false;
					});

					//コンテンツの読み込み完了時にモーダルウィンドウを開く
					function onComplete() {
						displayModal(true);
						$("div#modal div.container a.close").click(function() {
							displayModal(false);
							return false;
						});
					}

				}

				//モーダルウィンドウを開く
				function displayModal(sign) {
					if (sign) {
						$("div#modal").fadeIn(500);
					} else {
						$("div#modal").fadeOut(250);
					}
				}

				//ウィンドウの位置をセンターに調整
				function adjustCenter(target) {
					var margin_top = ($(window).height() - $(target).height()) / 2;
					var margin_left = ($(window).width() - $(target).width()) / 2;
					$(target).css({
						top : margin_top + "px",
						left : margin_left + "px"
					});
				}
			</script>
			
			<h4><?php echo $this -> Html -> link('Index', array('action' => 'index')); ?></h4>
			<!-- //Contents -->
			<hr />

			<!-- footer -->
			<footer id="footer">
				<p class="copyright">
					<small>copyright &copy; Bridge</small>
				</p>
			</footer>
			<!-- //footer -->

		</div>
		<!-- //Container -->
	</body>
</html>