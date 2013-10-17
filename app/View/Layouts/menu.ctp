<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('menu.css');
		echo $this->Html->css('background.css');
		echo $this->Html->css('font-awesome.min.css');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('buttons.css');
		
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu.js');
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.backstretch.min');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<header id="header">
		<div id="navi">
			<div id='link'>
				<!-- 各機能へのリンク -->
				<ul style="list-style:none" id="menu">
					<li style="float: left" id="home_logo"><?php echo $this->Html->image('../img/icon01.png',
								array('url'=>array('controller'=>'home','action'=>'index')));?></li>
					<li style="float:left"><?php echo $this->Html->link('ユーザー編集',array('controller' => 'users','action'=>'edit')); ?></li>
					<li style="float:left"><?php echo $this->Html->link('ログアウト',array('controller' => 'users','action'=>'logout')); ?></li>
					<li style="float:left"><?php echo $this->Html->link('テスト(ﾟﾟ;)',array('controller' => 'users','action'=>'test')); ?></li>
				</ul>
			</div>
		</div>
	</header>
	<div>
		<ul style="list-style: none" id="right" style="float: right;">
			<li style="float:left"><?php echo $this->Html->link('ログイン',array('controller' => 'users','action'=>'login')); ?></li>
			<li style="float:left"><?php echo $this->Html->link('新規登録',array('controller' => 'users','action'=>'add')); ?></li>
		</ul>
	</div>
	<?php echo $this->fetch('content'); ?>
	
</body>
</html>