<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>Bridge | login</title>
		<meta name="keywords" content="bridge登録" />
		<meta name="description" content="Register Bridge" />
		<meta name="author" content="shinya" />
		<meta name="copyright" content="Bridge">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<!-- <link rel="stylesheet" href="../../css/background.css"> -->
		<link rel="stylesheet" href="../../css/login.css">
		<link rel="stylesheet" href="../../css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/bootstrap.css">
		
		<script src="../../webroot/js/empty"></script>
		<script type='text/javascript' src='js/jquery.modal.js'></script>
		<script type='text/javascript' src='js/site.js'></script>
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		
		<style>
			h1 {
				color: #FFFFFF;
			}
			h3 {
				color: rgba(255,255,255, 0.85);
			}
		</style>
		
	</head>
	<body>
		<!-- Container -->
		<div id="login_form">
			<!-- Header -->
			<header id="login_header">
				<h3>ログイン</h3>
			</header>
			<!-- //Header -->

			
			<!-- Contents -->
			<div class='form'>
				<?php echo $this -> Session -> flash('auth'); ?>
				<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'login')); ?>
				<div class="form-group">
				    <?php echo $this -> Form -> input('email', array('type' => 'email', 'label' => 'メールアドレス', 'class' => 'input_email')); ?>
			  	</div>
		 		<div class="form-group">
				    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => 'password', 'class' => 'input_password')); ?>
		  		</div>
			  	<div class="form-group">	
			  		<?php echo $this -> form->submit('Login', array('type' => 'submit', 'class' => 'btn btn-lg btn-primary ')); ?>
			    	<?php echo $this -> Form -> end(); ?>
			    </div>	
			</div>
			<h4><?php echo $this -> Html -> link('Index', array('action' => 'index')); ?></h4>
			<!-- //Contents -->

			<!-- footer -->
			<!-- <footer id="footer">
				<p class="copyright">
					<small>copyright &copy; Bridge</small>
				</p>
			</footer> -->
			<!-- //footer -->

		</div>
		<!-- //Container -->
	</body>
</html>