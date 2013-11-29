<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap-glyphicons');
		echo $this->Html->css('bootstrap.min');
		// echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('all');
		echo $this->Html->css('menu');
		echo $this->Html->css('fonts');
		echo $this->Html->css('dropdown/style4');
		echo $this->Html->css('dropdown/style4-2');
		
	
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.ajaxFrom');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('dropdown/jquery.dropdown');
		echo $this->Html->script('dropdown/modernizr.custom.63321');
		echo $this->Html->script('dropdown/jump');
		echo $this->Html->script('jquery-validation/dist/jquery.validate.min');
		echo $this->Html->script('jquery-validation/dist/additional-methods.min');
		echo $this->Html->script('jquery-validation/localization/messages_ja');

		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script>
		/* for Style */
		$('.dropdown-toggle').dropdown();
		$('#loginModal').modal();
		$('#signModal').modal();
		$( function() {		
				$( '#cd-dropdown' ).dropdown();
		});
	
		$(function(){
			/* jquery.validate.js for Bootstrap3 */
			$.validator.setDefaults({
				highlight: function(element) {
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error');
				},
				errorElement: 'span',
				errorClass: 'help-block',
				errorPlacement: function(error, element) {
					if(element.parent('.input-group').length) {
						error.insertAfter(element.parent());
					} else {
						error.insertAfter(element);
					}
				}
			});
			
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
			$('#UserAddForm').validate(userAddFormOptions)
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
						$('#UserLoginForm .container').prepend('<div class="form-group has-error"><span class="help-block">'+ error +'</span></div>')
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

</head>
	<body>
		<div id="container">
			<header id="header">
				<div id="navi">
					<div id='link'>
						<!-- 各機能へのリンク -->
						<a id="home-logo" class="home_logo" href="../home/index" style="float:right"><div class="home_logo"></div></a>
						<ul style="list-style:none" id="menu" style="float:left">
							
							<li class="dropdown" id="menu-create" style="float:left">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#menu-create">
									Create
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="/blogs/index"><i class="glyphicon glyphicon-pencil"></i>　日記作成</a></li>
									<li><a href="#"><i class="glyphicon glyphicon-film"></i>　作品登録</a></li>
									<li><a href="#"><i class="glyphicon glyphicon-tags"></i>　タグ編集</a></li>
								</ul>
							</li>
							
							<li style="float:left"><a href="/search/index">Search</a></li>
							<li style="float:left"><a>Gallery</a></li>
							<li style="float:left"><a href="/images/index">Upload</a></li>
							<li style="float:left"><a>About Us</a></li>
							
							<li style="float:left">
								<div class="fleft">
									<select onchange="top.location.href=value" name="select"  id="cd-dropdown" class="cd-select select">
										<option value="-1" selected>Create</option>
										<option value="../../blogs/index">Diary</option>
										<option value="../../blogs/index">Movies</option>
										<option value="../../blogs/index">Tags</option>
										<option value="4">ABE</option>
									</select>
								</div>
							</li>
						</ul>
						
						<div class="auth">
							<ul style="list-style: none" id="right" style="float: right;">
								<?php if($user == null) {?>
									<li>
										<a href="#" data-target="#loginModal" data-toggle="modal" class="menu-list" style="float:right">Login</a>
									</li>
									<li>
										<a href="#" data-target="#signModal" data-toggle="modal" class="menu-list" style="float:right">Sign up</a>
									</li>
								<?php } else { ?>
									<li class="dropdown" id="menu-user" style="float:right">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#menu-user">
											<?php echo $user['name']; ?>
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="/users/edit"><i class="glyphicon glyphicon-user"></i>　ユーザー編集</a></li> 
											<li><a href="#"><i class="glyphicon glyphicon-star"></i>　お気に入り</a></li> 
											<li><a href="#"><i class="glyphicon glyphicon-star"></i>　設定</a></li>
											<li class="divider"></li>
											<li><a href="/users/logout"><i class="glyphicon glyphicon-log-out"></i>　ログアウト</a></li>
										</ul>
									</li>
									
								<?php }?>
							</ul>
				        </div>
					</div>
				</div>
			</header>
		</div>

		<!-- ログインモーダル -->
		<div class="modal fade" id="loginModal">
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
						<h4 class="modal-title">Login</h4>
					</div>
					<div class="modal-body">
						<div id="loginContent" class="container">
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
						</div>
						<div class="modal-footer">
							<?php echo $this->Form->submit('Login', array('class' => 'btn-a')); ?>
						</div>
					</div>
				</div><!-- /.modal-content -->
				<?php echo $this->Form->end(); ?>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
			
		<div class="modal fade" id="signModal">
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
						<h4 class="modal-title">Sign up</h4>
					</div>
					<div class="modal-body">
						<div id="addContent" class="container">
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
						</div>
						<div class="modal-footer">
							<?php echo $this->Form->submit('Sign up', array('class' => 'btn-a')); ?>
						</div>
					</div><!-- /.modal-body -->
				</div><!-- /.modal-content -->
				<?php echo $this->Form->end(); ?>
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div id="contents">
			<div id="loginResult" style="display:none;"></div>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		
		<footer id="footer">
			<p class="copyright">
				<small>&copy; Bridge</small>
			</p>
		</footer>
		
		<script>
			// this is important for IEs
			var polyfilter_scriptpath = '/js/';
		</script>
		
	</body>
</html>