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
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'url'=>'login'));?>
			<table>
				<tr>
					<th><?php echo $this->Form->label('id','ユーザーID'); ?></th>
					<td><?php echo $this->Form->text('id'); ?></td>
				</tr>
				<tr>
					<th><?php echo $this->Form->label('パスワード') ?></th>
					<td><?php echo $this->Form->text('password') ?></td>
				</tr>
			</table>
			<?php echo $this->Form->submit('ログイン') ?>
			<?php echo $this->Form->end(); ?>
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'url'=>'add'));?>
			<?php echo $this->Form->submit('新規登録') ?>
			<?php echo $this->Form->end(); ?>
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