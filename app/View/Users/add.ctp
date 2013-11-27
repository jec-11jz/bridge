<?php
	//echo $this->Html->script('CopyofuserAdd');
?>
<p><?php echo $this->Session->flash('register'); ?></p>
<p>
	<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'add', 'id'=>'mainform')); ?>
	<?php
		echo $this -> Form -> input('name', array('label' => false, 'type' => 'text', 'class' => 'input_form', 'placeholder' => 'ユーザーID'));
	?>
	<?php
		echo $this -> Form -> input('password', array('label' => false, 'type' => 'password', 'class' => 'input_form', 'placeholder' => 'パスワード', 'error' => array('notEmpty' => __('※パスワードを入力してください。', true), 'between' => __('※6文字以上15文字以内で入力してください', true))));
	?>
	<?php
		echo $this -> Form -> input('password_check', array('label' => false, 'type' => 'password', 'class' => 'input_form', 'placeholder' => 'パスワードの再入力', 'error' => array('notEmpty' => __('※パスワード(再入力)を入力してください。', true), 'sameCheck' => __('※パスワード(再入力)がパスワードと異なります。', true))));
	?>
	<?php
		echo $this -> Form -> input('email', array('label' => false, 'type' => 'email', 'class' => 'input_form', 'placeholder' => 'メールアドレス', 'error' => array('email' => __('※メールアドレスを正しく入力してください。', true), 'isUnique' => __('※そのメールアドレスは既に使用されています', true))));
	?>
</p>
</div>
<div class="modal-footer">
	<?php echo $this -> JS -> submit('Sign up', array('type' => 'submit', 'id'=>"register", 'class' => 'btn-custom btn-sign')); ?>
	<?php echo $this -> Form -> end(); ?>
</div>