<p><h1>HELLO Welcom to Bridge</h1></p>
<!-- 認証エラーメッセージの表示 -->
<p><?php echo $this->Session->flash('auth'); ?></p>
<!-- CakePHPのバージョン表示 -->
<p>CakePHP verson : <?php echo Configure::version() ?></p>
<!-- 各機能へのリンク -->
<h1><?php echo $this->Html->link('ログイン',array('controller' => 'home', 'action'=>'index')); ?></h1>
<h1><?php echo $this->Html->link('新規登録',array('action'=>'add')); ?></h1>
<h1><?php echo $this->Html->link('ユーザー編集',array('action'=>'edit')); ?></h1>
<h1><?php echo $this->Html->link('ログアウト',array('action'=>'logout')); ?></h1>


<div class='userList'>
	<h2>ユーザ一覧表示</h2>
	<hr/>
	<table>
	    <?php foreach($userList as $list): ?>
	       <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
	        	<tr>
		        	<th>UserID</th>
		        	<td><?php echo h($list['User']['name']); ?></td>
		        	<th>Nickname</th>
		        	<td><?php echo h($list['User']['nickname']); ?></td>
		        	<th>email</th>
		        	<td><?php echo h($list['User']['email']); ?></td>
		        </tr>
	    <?php endforeach; ?>
	</table>
	<hr/>
