<?php

?>
<script>
$(function(){
	var userLoginFormOptions = {
		rules: {
			'data[User][email]': {
				required: true,
				email: true
			},
			'data[User][password]': {
				required: true
			}
		}
	};
	
	var userAddFormOptions = {
		rules: {
			'data[User][name]': {
				required: true,
				pattern: '[a-zA-Z0-9_]*',
				rangelength: [3,30]
			},
			'data[User][password]': {
				required: true,
				minlength: 6
			},
			'data[User][password_check]': {
				required: true,
				minlength: 6,
				equalTo: '#UserAddForm input[name="data[User][password]"]'
			},
			'data[User][email]': {
				required: true,
				email: true
			}
		},
		messages: {
			'data[User][name]': {
				pattern: '使用できるのは半角英数字のみです'
			}
		}
	};

	
	$('#UserLoginForm').validate(userLoginFormOptions);
	$('#UserAddForm').validate(userAddFormOptions);
	
	$('#UserAddForm').ajaxForm({
		success: function(data) {
			if (!data.errors) {
				// success
				location.reload();
				return;
			}
			
			// error
			$.each(data.errors, function(key, error){
				console.log('key:'+ key);
				console.log('error: '+ error);
				var errorBlock = $('#UserAddForm input[name="data[User]['+ key +']"]');
				errorBlock.closest('.form-group').addClass('has-error');
				errorBlock.after('<span class="help-block">'+ error +'</span>');
			});
		},
		error: function(data) {
			console.log(data);
			alert('connection error');
			return;
		}
	});
	
	$('#UserLoginForm').ajaxForm({
		dataType: 'json',
		success: function(data) {
			if (!data.errors) {
				// success
				location.reload();
				return;
			}
			
			// error
			$.each(data.errors, function(key, error){
				$('#UserLoginForm .modal-body').prepend('<div class="form-group has-error"><span class="help-block">'+ error +'</span></div>')
				$('#UserLoginForm .form-group').addClass('has-error');
			});
		},
		error: function(data) {
			console.log(data);
			alert('connection error!!');
			return;
		}
	});
	
				
});
</script>
<!--
	Login modal
-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<?php
			echo $this->Form->create('User', array(
					'type'=>'post',
					'action'=>'login',
					'role' => 'form'
				)
			);
			$this->Form->inputDefaults(array(
				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
				'class' => 'input_form form-control',
				'id' => null,
				'div' => 'form-group',
				'label' => false,
			));
		?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="loginModalLabel">Login</h4>
			</div>
			<div class="modal-body">
				<?php
					echo $this->Form->input(
						'email', 
						array(
							'placeholder' => 'メールアドレス'
						)
					);
					echo $this->Form->input('password', 
						array(
							'placeholder' => 'パスワード'
						)
					);
				?>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<?php echo $this->Form->submit('Login', array('class' => 'btn-a')); ?>
			</div>
		</div><!-- /.modal-content -->
		<?php echo $this->Form->end(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--
	SignUp modal
-->
<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="signModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<?php
			echo $this->Form->create('User', array(
					'type'=>'post',
					'action'=>'add',
					'role' => 'form'
				)
			);
			$this->Form->inputDefaults(array(
				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
				'class' => 'input_form form-control',
				'id' => null,
				'div' => 'form-group',
				'label' => false,
			));
		?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="signModalLabel">Sign up</h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->Form->input(
						'name',
						array(
							'placeholder' =>'ユーザーID'
						)
					);
					
					echo $this->Form->input(
						'password',
						array(
							'placeholder' =>'パスワード'
						)
					); 

					echo $this->Form->input(
						'password_check',
						array(
							'type' => 'password',
							'placeholder' =>'パスワードの再入力'
						)
					); 

					echo $this->Form->input(
						'email', 
						array(
							'placeholder' =>'メールアドレス'
						)
					); 
				?>
			</div><!-- /.modal-body -->
			<div class="modal-footer">
				<?php echo $this->Form->submit('Sign up', array('class' => 'btn-a')); ?>
			</div>
		</div><!-- /.modal-content -->
		<?php echo $this->Form->end(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->