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
				<h1>ユーザー登録</h1>
			</header>
			<!-- //Header -->

			<hr />
			<!-- Contents -->
			<div class='login form'>
				<?php echo $this->Session->flash('auth'); ?>
				
				<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'login')); ?>
					<?php echo $this->Form->input('id', array('type' => 'text', 'label' => 'ユーザーID')); ?>
					<?php echo $this->Form->input('password', array('type' => 'password', 'label' => 'password')); ?>
				<?php echo $this->Form->end('ログイン'); ?>
			</div>
			<h1><?php echo $this->Html->link('新規登録',array('action'=>'add')); ?></h1>
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