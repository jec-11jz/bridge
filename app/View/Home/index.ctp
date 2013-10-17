<?php
	echo $this->Html->css('toppage.css');
	echo $this->Html->css('login.css');
?>
	
<body>
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
	<!-- Container -->
	<div id="toppage">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div id='link'>
			<ul style="list-style:none">
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon02.jpg',
							array('url'=>array('controller'=>'users','action'=>'index'), 'class' => 'logo'));?><br/>作品検索</li>
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon07.jpeg',
							array('url'=>array('controller'=>'users','action'=>'add'), 'class' => 'logo'));?><br/>登録</li>
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon06.jpg',
							array('url'=>array('controller'=>'users','action'=>'login'), 'class' => 'logo'));?><br/>日記作成</li>
			</ul>
		</div>
		<!-- //Contents -->
		
		<!-- footer --><!-- //footer -->
	</div>
	<!-- //Container -->
</body>