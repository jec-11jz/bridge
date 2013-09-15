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
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'login')); ?>
			<table>
				<tr>
					<th>ユーザーID</th>
					<td><?php echo $this->Form->input('id', array('type' => 'text', 'label' => false)); ?></td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td><?php echo $this->Form->input('password', array('type' => 'password', 'label' => false)); ?></td>
				</tr>
			</table>
			<?php echo $this->Form->end('ログイン'); ?>
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'url'=>'add')); ?>
			<?php echo $this->Form->end('新規登録'); ?>
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