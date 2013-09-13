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
				<h1>ユーザー登録確認</h1>
			</header>
			<!-- //Header -->

			<hr />
			<!-- Contents -->
			<table>
				<tr>
					<th>ユーザーID</th>
					<td><?php echo h($this->Data['User']['id']); ?></td>
				</tr>
				<tr>
					<th>ユーザー名</th>
					<td><?php echo h($this->Data['User']['nickname']); ?></td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td><?php echo h($this->Data['User']['password']); ?></td>
				</tr>
				<tr>
					<th>パスワードの確認</th>
					<td><?php echo h($this->Data['User']['password_check']); ?></td>
				</tr>
				<tr>
					<td><?php echo h($this->Data['User']['email']); ?></td>
				</tr>
				<tr>
					<td colspan='2'>
						<?php
							//キャンセル用のフォーム
							echo $this->Form->create('User', array('action' => 'add'));
							//値をaddに戻す(なくてもいいかも)
 							foreach($this->request->data['User'] as $key => $val):
	 							if($key!='confirm'){
	 								echo $this->Form->input($key, array('label' => false, 'type' => 'hidden', 'value' => h($val)));
								}
							endforeach;
							echo $this->Form->input('cancel', array('type' => 'hidden', 'value' => true));
							echo $this->Form->submit('Cancel', array('name' => 'Cancel', 'class' => 'btn btn-primary', 'div' => false));
							echo $this->Form->end();
						?>
					</td>
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