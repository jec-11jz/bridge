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
			<p><h1>HELLO Welcom to Bridge</h1></p>
			<!-- CakePHPのバージョン表示 -->
			<p><?php echo Configure::version() ?></p>
			<!-- 各機能へのリンク -->
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'login'));?>
			<?php echo $this->Form->end('ログイン'); ?>
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'add')); ?>
			<?php echo $this->Form->end('新規登録'); ?>
			<table>
				<tr>
					<th>とりあえずルートユーザを呼び出してる</th>
					<td><?php echo $this->Html->link('ユーザー編集',array('action'=>'edit',$user['User']['id'])); ?></td>
				</tr>
			</table>
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