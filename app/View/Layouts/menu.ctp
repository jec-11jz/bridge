<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('menu');
		echo $this->Html->css('background');
	
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('footerFixed'); //フッターをウィンドウの一番下に固定する(現在はcssで実装している)


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
	<body>
		<div id="container">
			<header id="header">
				<div id="navi">
					<div id='link'>
						<!-- 各機能へのリンク -->
						<a clas="home_logo" href="../home/index" style="float:right"><div class="home_logo"></div></a>
						<ul style="list-style:none" id="menu" style="float:left">
							<!-- <a clas="home_logo" href="bridge.com/"><img src="../img/Bridge_cool.gif"></img></a> -->
							<li style="float:left"><?php echo $this->Html->link('ユーザー編集',array('controller' => 'users','action'=>'edit')); ?></li>
							<li style="float:left"><?php echo $this->Html->link('ログアウト',array('controller' => 'users','action'=>'logout')); ?></li>
							<li style="float:left"><?php echo $this->Html->link('テスト(ﾟﾟ;)',array('controller' => 'users','action'=>'test')); ?></li>
						</ul>
						<div class="auth">
							<ul style="list-style: none" id="right" style="float: right;">
								<?php if($user == null) {?>
										<li style="float:left"><?php echo $this->Html->link('sign in',array('controller' => 'users','action'=>'login')); ?></li>
										<li style="float:left"><?php echo $this->Html->link('sign up',array('controller' => 'users','action'=>'add')); ?></li>
								<?php } else { ?>
										<li style="float:right"><a href=""><?php echo $user['name']; ?></a></li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</header>
		</div>

		
		<div id="contents">
			<?php echo $this->fetch('content'); ?>
		</div>
		
		<footer id="footer">
			<p class="copyright">
				<small>&copy; Bridge</small>
			</p>
		</footer>
	</body>
</html>