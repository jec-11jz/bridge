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
			    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => 'password', 'class' => 'input_password')); ?>	
		  		<?php echo $this -> form->submit('Login', array('type' => 'submit', 'class' => 'button-custom btn')); ?>
		    	<?php echo $this -> Form -> end(); ?>
		    </div>	
		</div>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->
	</div>
	<!-- //Container -->
</body>
