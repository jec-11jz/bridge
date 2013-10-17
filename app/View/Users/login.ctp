<?php
	echo $this->Html->css('login.css');
?>
<body>
	<!-- Container -->
	<div id="login_form">
		<!-- Header --><!-- //Header -->

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

		<!-- footer --><!-- //footer -->
	</div>
	<!-- //Container -->
</body>
