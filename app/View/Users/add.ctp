<!DOCTYPE html>
<html>
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
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'add')); ?>
			<table>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('name', array(
								'label'=>'ユーザーID', 
								'type'=>'text',
								'error' => array(
									'isUnique' => __('そのユーザーIDは既に使われています', true),
									'custom' => __('半角英数字のみ使用できます', true),
									'minLength' => __('15文字以内で入力してください', true)))); 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('nickname', array(
								'label' => 'ユーザー名',
								'error' => array(
									'maxLength' => __('30文字以内で入力してください', true)))); 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('password',array(
								'label' => 'パスワード',
								'type' => 'password',
								'error' => array(
									'notEmpty' => __('パスワードを入力してください。', true),
									'between' => __('6文字以上15文字以内で入力してください', true)))); 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('password_check', array(
								'label' => 'パスワードの再入力', 
								'type' => 'password',
								'error' => array(
									'notEmpty' => __('パスワード(再入力)を入力してください。', true),
									'sameCheck' => __('パスワード(再入力)がパスワードと異なります。', true)))); 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('email', array(
								'label' => 'メールアドレス',
								'type' => 'email',
								'error' => array(
									'email' => __('メールアドレスを正しく入力してください。', true),
									'isUnique' => __('そのメールアドレスは既に使用されています', true)))); 
						?>
					</td>
				</tr>
			</table>
			<?php echo $this->Form->button('リセット' ,array('type' => 'reset')); ?>
			<?php echo $this->Form->end('新規登録'); ?>
			<?php echo $this->Form->create('User',array('type'=>'post', 'action'=>'index')); ?>
			<?php echo $this->Form->end('キャンセル'); ?>
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