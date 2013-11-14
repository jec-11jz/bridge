<?php
	echo $this->Html->css('user_add');
	echo $this->Html->css('bootstrap.min');
?>
<body>
	<!-- Container -->
	<div id="container">
	<!-- Header --><!-- //Header -->
	
	<!-- Contents -->
	<div id="contents">
	<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'add')); ?>
	<div class="user_add">
		<div class="add_form">
			<?php 
				echo $this->Form->input('name', array(
					'label' => false,
					'type'=>'text',
					'class'=>'input_form',
					'placeholder' =>'ユーザーID',
					'error' => array(
						'isUnique' => __('※そのユーザーIDは既に使われています', true),
						'custom' => __('※半角英数字のみ使用できます', true),
						'minLength' => __('※15文字以内で入力してください', true)))); 
			?>
			<?php 
				echo $this->Form->input('nickname', array(
					'label' => false,
					'class'=>'input_form',
					'placeholder' =>'ユーザー名',
					'error' => array(
						'maxLength' => __('※30文字以内で入力してください', true)))); 
			?>
			<?php 
				echo $this->Form->input('password',array(
					'label' => false,
					'type' => 'password',
					'class'=>'input_form',
					'placeholder' =>'パスワード',
					'error' => array(
						'notEmpty' => __('※パスワードを入力してください。', true),
						'between' => __('※6文字以上15文字以内で入力してください', true)))); 
			?>
			<?php 
				echo $this->Form->input('password_check', array(
					'label' => false, 
					'type' => 'password',
					'class'=>'input_form',
					'placeholder' =>'パスワードの再入力',
					'error' => array(
						'notEmpty' => __('※パスワード(再入力)を入力してください。', true),
						'sameCheck' => __('※パスワード(再入力)がパスワードと異なります。', true)))); 
			?>
			<?php 
				echo $this->Form->input('email', array(
					'label' => false,
					'type' => 'email',
					'class'=>'input_form',
					'placeholder' =>'メールアドレス',
					'error' => array(
						'email' => __('※メールアドレスを正しく入力してください。', true),
						'isUnique' => __('※そのメールアドレスは既に使用されています', true)))); 
			?>
		</div>
		<div class="add_button">

			<!-- <?php echo $this->Form->button('リセット' ,array('type' => 'reset', 'class' => 'btn-custom btn left')); ?> -->
			<?php echo $this ->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-custom btn right')); ?>
			<a href="../home/index" class="btn-custom left">キャンセル</a>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
	</div>
	<!-- //Contents -->
	
	<!-- footer --><!-- //footer -->
	</div>
	<!-- //Container -->
</body>