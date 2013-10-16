<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Bridge | TopPage</title>
		<meta name="keywords" content="bridge登録" />
		<meta name="description" content="Register Bridge" />
		<meta name="author" content="shinya" />
		<meta name="copyright" content="Bridge">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="../../css/bootstrap.css">
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/background.css">
		
		<script type='text/javascript' src='js/jquery.modal.js'></script>
		<script type='text/javascript' src='js/site.js'></script>
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		
		<style>
			
			li.logo {
				width: 250px;
				height: 250px;
				background-color: rgba(20,220,45, 0.25);
				background-repeat: no-repeat;
				background-attachment: fixed;
				margin: 10% 0px 0px 6%; /*　上　右　下　左 */
				border-radius: 20px;
				text-align: center;
				font-size: 30px;
				color: rgba(0,0,0, 0.7);
				text-shadow: 2px 2px 2px #999999, -2px -2px 2px #999999;
			}
			footer#footer{
				height: 10px;
				position: absolute;
				bottom: 0;
			}
			div#toppage {
			
			}
			div#link{
				width: 100%;
				margin: 0 auto; /*センタリング*/
			}
			img.logo{
				width: 230px;
				height: 230px;
				border-radius: 20px;
			}
			li.link_name{
				color: #FFFFFF
				clear: both;
			}
		</style>
		<SCRIPT language="JavaScript">
			// // ランダムに背景を変更する (動かない)
			bgi = new Array();
			bgi[0] = url("<?php echo $this -> Html -> url('../img/loginImage03.jpg'); ?>");
			bgi[1] = url("<?php echo $this -> Html -> url('../img/loginImage02.jpg'); ?>");
			bgi[2] = url("<?php echo $this -> Html -> url('../img/loginImage01.jpg'); ?>");
			bgi[3] = url("<?php echo $this -> Html -> url('../img/loginImage04.jpg'); ?>");
			bgi[4] = url("<?php echo $this -> Html -> url('../img/loginImage05.jpg'); ?>");
			bgi[5] = url("<?php echo $this -> Html -> url('../img/loginImage06.jpg'); ?>");
			
			function change(){   
				n = Math.floor(Math.random()*bgi.length);
				document.body.background = bgi[n]
			}
		</SCRIPT>
	</head>
	
	<body onload="javascript: change();">
		<!-- Container -->
		<div id="toppage">
			<!-- Header -->
			
			<!-- //Header -->

			<!-- Contents -->
			    <!-- ここのコンテンツ -->
			<div id='link'>
				<ul style="list-style:none">
					<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon02.jpg',
								array('url'=>array('controller'=>'users','action'=>'index'), 'class' => 'logo'));?><br/>作品検索</li>
					<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon07.jpeg',
								array('url'=>array('controller'=>'users','action'=>'add'), 'class' => 'logo'));?><br/>登録</li>
					<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon06.jpg',
								array('url'=>array('controller'=>'users','action'=>'login'), 'class' => 'logo'));?><br/>ログイン</li>
				</ul>
			</div>
			<a class="modalLink"><?php echo $this->Html->link('ログイン',array('controller' => 'users','action'=>'login')); ?></a>
			<div class="modal">
				<div class="overlay"></div>
				<a href="#" class="closeBtn">Close Me</a>
			</div>
			<!-- //Contents -->
			<!-- footer -->
			<footer id="footer">
				<p class="copyright">
					<small>copyright &copy; Bridge</small>
				</p>
			</footer>
			<!-- //footer -->

		</div>
		<!-- //Container -->
	<div id="backgroud">
	<div id="over">
	</div>
	</div>
	</body>
</html>