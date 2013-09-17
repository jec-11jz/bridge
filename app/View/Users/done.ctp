<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
		<meta name="keywords" content="bridge登録" />
		<meta name="description" content="Register Bridge" />
		<meta name="author" content="shinya" />
		<meta name="copyright" content="Bridge">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="../../webroot/css/cake.generic.css">
		<script src="../../webroot/js/empty"></script>
	</head>
	<body>
		<!-- Container -->
		<div id="container">
			<!-- Header -->
			<header id="header">
				<h1>実行完了</h1>
			</header>
			<!-- //Header -->

			<hr />
			<!-- Contents -->
			<h1><?php echo $this->Html->link('Index',array('action'=>'index')); ?></h1>
			<h1><?php echo $this->Html->link('ログアウト',array('action'=>'logout')); ?></h1>
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