<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('menu');
		echo $this->Html->css('background');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap');
		
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.backstretch.min');
		echo $this->Html->script('footerFixed'); //フッターをウィンドウの一番下に固定する(現在はcssで実装している)


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
				<li style="float:left"><?php echo $this->Html->link('sign in',array('controller' => 'users','action'=>'login')); ?></li>
				<li style="float:left"><?php echo $this->Html->link('sign up',array('controller' => 'users','action'=>'add')); ?></li>
			</ul>
		</div>
		<?php echo $this->fetch('content'); ?>
		
		<footer id="footer">
			<p class="copyright">
				<small>&copy; Bridge</small>
			</p>
		</footer>
	</body>
</html>