<h1>トップ画面</h1>
<p>こちらはトップ画面です</p>
<p>ログインしていないと表示されます</p>
<div>
	<?php echo $this->Form->create('User', array('action' => 'post','url' => '/login')); ?>
	<table class="Form">
		<tr>
			<th>メールアドレス</th>
			<td><?php echo $this->Form->input('mail_address', array('label' => false)); ?></td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td><?php echo $this->Form->input('password', array('label' => false)); ?></td>
		</tr>
	</table>
	<?php echo $this->Form->end('ログイン'); ?>
</div>

