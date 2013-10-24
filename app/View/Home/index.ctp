<?php
	echo $this->Html->css('toppage.css');
	echo $this->Html->css('login.css');
?>
	
<body>
	<div id="container">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div class="contents">
			<div class='form'>
				<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'login')); ?>
				<div class="form-group">
				    <?php echo $this -> Form -> input('email', array('type' => 'email', 'label' => 'メールアドレス', 'class' => 'input_email')); ?>
			  	</div>
		 		<div class="form-group">
				    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => 'password', 'class' => 'input_password')); ?>
		  		</div>
			  	<div class="form-group">	
			  		<?php echo $this -> form->submit('Login', array('type' => 'submit', 'class' => 'btn btn-custom')); ?>
			    	<?php echo $this -> Form -> end(); ?>
			    </div>	
			</div>
		
		<div id="toppage">
			<div class='toppage_link'>
				<a class="logo" href="../users/index"><div class="logo img-book"></div><br/>作品検索</a>
				<a class="logo" href="../users/add"><div class="logo img-book2"></div><br/>登録</a>
				<a class="logo" href="../blogs/index"><div class="logo img-book3"></div><br/>日記作成</a>
			</div>
			<!-- //Contents -->
			
			<!-- footer --><!-- //footer -->
		</div>
	</div>
	<!-- //Container -->
</body>