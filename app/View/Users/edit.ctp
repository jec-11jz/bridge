<div class="signup">
	<?php echo $this->Session->flash('register'); ?></p>
	<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'add')); ?>
	<?php
		echo $this -> Form -> input('name', array('label' => false, 'type' => 'text',
				'class' => 'input_form', 'placeholder' => 'ユーザーID'));
	?>
	<?php
		echo $this -> Form -> input('nickname', array('label' => false, 
				'class' => 'input_form', 'placeholder' => 'ユーザー名', 
				'error' => array('maxLength' => __('※30文字以内で入力してください', true))));
	?>
	<?php
		echo $this -> Form -> input('email', array('label' => false, 'type' => 'email',
				'class' => 'input_form', 'placeholder' => 'メールアドレス',
				'error' => array('email' => __('※メールアドレスを正しく入力してください。', true),
						'isUnique' => __('※そのメールアドレスは既に使用されています', true))));
	?>
	<div class="login-footer">
		<?php echo $this -> Form -> submit('Sign up', array('type' => 'submit', 'id' => 'form', 'class' => 'btn-custom btn-sign')); ?>
		<?php echo $this -> Form -> end(); ?>
	</div>
</div> <!-- END signup -->