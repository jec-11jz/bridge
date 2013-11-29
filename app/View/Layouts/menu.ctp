<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap-glyphicons');
		echo $this->Html->css('bootstrap.min');
		// echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('menu');
		echo $this->Html->css('dropdown/style4');
		echo $this->Html->css('jQuery-Validation-Engine-master/validationEngine.jquery');
		
	
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.ajaxFrom');
		echo $this->Html->script('login');
		echo $this->Html->script('userAdd');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('dropdown/jquery.dropdown');
		echo $this->Html->script('dropdown/modernizr.custom.63321');
		echo $this->Html->script('dropdown/jump');
		echo $this->Html->script('jQuery-Validation-Engine-master/languages/jquery.validationEngine-ja');
		echo $this->Html->script('jQuery-Validation-Engine-master/jquery.validationEngine');
		
		
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script>
		$('.dropdown-toggle').dropdown();
		$('#loginModal').modal();
		$('#signModal').modal();
		$( function() {
				
				$( '#cd-dropdown' ).dropdown();

		});
		
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#loginForm").validationEngine();
		});
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#addForm").validationEngine();
		});

	</script>

	
</head>
	<body>
		<div id="container">
			<header id="header">
				<div id="navi">
					<div id='link'>
						<!-- 各機能へのリンク -->
						<a id="home-logo" class="home_logo" href="../home/index" style="float:left"><div class="home_logo"></div></a>
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
							
							<li style="float:left"><a href="/searches/index">Search</a></li>
							<li style="float:left"><a>Gallery</a></li>
							<li style="float:left"><a href="/images/index">Upload</a></li>
							<li style="float:left"><a>About Us</a></li>
							
							<li style="float:left">
								<div class="fleft">
									<select onchange="locations.href=value" name="select"  id="cd-dropdown" class="cd-select select">
										<option value="-1" selected>Create</option>
										<option value="../../blogs/index">Diary</option>
										<option value="../../blogs/index">Movies</option>
										<option value="../../blogs/index">Tags</option>
										<option value="4">ABE</option>
									</select>
								</div>
							</li>
						</ul>
						<ul class="list-blank" style="float:right"></ul>
						<div class="auth">
							<ul style="list-style: none" id="right" style="float: right;">
								<?php if($user == null) {?>
									<li>
										<a href="#" data-target="#loginModal" data-toggle="modal" class="menu-list list-login" style="float:right">Login</a>
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
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Login</h4>
					</div>
					<div class="modal-body">
						<div id="loginContent" class="container">
							<?php echo $this -> Form -> create('User', array('type' => 'post', 'action'=>'login', 'id'=>'loginForm')); ?>
							<?php echo $this -> Form -> input('email', 
								array('type' => 'email', 'label' => false, 'id'=>'email', 'name'=>'email', 'error'=>false,
									'class' => 'input_form form-control validate[required,custom[email]]', 'placeholder' => 'メールアドレス',
									'data-errormessage-value-missing'=>"*必須です!",
		   							'data-errormessage-custom-error'=>"*正確なメールアドレスを入力してください",
		    						'data-errormessage'=>"This is the fall-back error message.")); ?>
							<?php echo $this -> Form -> input('password', 
								array('type' => 'password', 'label' => false, 'id'=>'password', 'error'=>false,
									'class' => 'input_form form-control validate[required,minSize[6],maxSize[15]]', 'name'=>'password',  'placeholder' => 'パスワード',
									'data-errormessage-value-missing'=>"*必須です!",
		   							'data-errormessage-custom-error'=>"*パスワードを入力してください")); ?>
						</div>
						<div class="modal-footer">
							<?php echo $this -> Form -> submit('Login', array('type' => 'submit', 'id'=>'submit', 'class' => 'btn-a')); ?>
							<?php echo $this -> Form -> end(); ?>
						</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
			
		<div class="modal fade" id="signModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Sign up</h4>
					</div>
					<div class="modal-body">
						<div id="addContent" class="container">
							<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'add', 'id'=>'addForm')); ?>
							<?php 
								echo $this->Form->input('name', 
									array('label' => false, 'type'=>'text', 'id'=>'name', 'name'=>'name',
										'class'=>'input_form form-control validate[required]', 'placeholder' =>'ユーザーID',
										'data-errormessage-value-missing'=>"*必須です!"));
							?>
							<?php 
								echo $this->Form->input('password',array(
										'label' => false,
										'type' => 'password',
										'id'=>'password',
										'class'=>'input_form form-control',
										'placeholder' =>'パスワード',
										'error' => array(
											'notEmpty' => __('※パスワードを入力してください。', true),
											'between' => __('※6文字以上15文字以内で入力してください', true)))); 
							?>
							<?php 
								echo $this->Form->input('password_check', array(
										'label' => false, 
										'type' => 'password',
										'id'=>'confirm',
										'class'=>'input_form form-control',
										'placeholder' =>'パスワードの再入力',
										'error' => array(
											'notEmpty' => __('※パスワード(再入力)を入力してください。', true),
											'sameCheck' => __('※パスワード(再入力)がパスワードと異なります。', true)))); 
							?>
							<?php 
								echo $this->Form->input('email', array(
										'label' => false,
										'type' => 'email',
										'id'=>'email',
										'class'=>'input_form form-control',
										'placeholder' =>'メールアドレス',
										'error' => array(
											'email' => __('※メールアドレスを正しく入力してください。', true),
											'isUnique' => __('※そのメールアドレスは既に使用されています', true)))); 
							?>
						</div>
						<div class="modal-footer">
							<?php echo $this ->Form->submit('Sign up', array('type' => 'submit', 'class' => 'btn-a')); ?>
							<?php echo $this->Form->end(); ?>
							
						</div>
					</div>
				</div><!-- /.modal-content -->
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