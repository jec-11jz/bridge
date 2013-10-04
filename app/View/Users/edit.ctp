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
			<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'edit')); ?>
			<table>
				<tr>
					<td>
						<?php echo 'ユーザＩＤ : ' . $loginInformation['name']; ?>
						<?php 
							echo $this->Form->input('name', array(
								'label'=>'ユーザーID', 
								'type'=>'text',
								'error' => array(
									'isUnique' => __('そのユーザーIDは既に使われています', true),
									'alphanumeric' => __('半角英数字のみ使用できます', true),
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
							echo $this->Form->input('email', array(
								'label' => 'メールアドレス',
								'type' => 'email',
								'error' => array(
									'email' => __('メールアドレスを正しく入力してください。', true),
									'isUnique' => __('そのメールアドレスは既に使用されています', true)))); 
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							echo $this->Form->input('profile', array(
								'label' => 'プロフィール',
								'type' => 'text')); 
						?>
					</td>
				</tr>
			</table>
			<?php echo $this->Form->end('変更を保存'); ?>
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