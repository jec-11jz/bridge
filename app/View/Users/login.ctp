<?php
	echo $this->Html->css('toppage');
?>
<div class='form'>
	<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'login')); ?>
	<div class="form-group">
	    <?php echo $this -> Form -> input('email', array('type' => 'email', 'label' => false, 'class' => 'input_email','placeholder' => 'email')); ?>
	    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => false, 'class' => 'input_password','placeholder' => 'password')); ?>
  		<?php echo $this -> form->submit('Login', array('type' => 'submit', 'class' => 'btn btn-custom')); ?>
    	<?php echo $this -> Form -> end(); ?>
	</div><!-- END form-group -->
</div> <!-- END form -->
