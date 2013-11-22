<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-glyphicons');
		echo $this->Html->css('all');
		echo $this->Html->css('menu');
		echo $this->Html->css('fonts');
		echo $this->Html->css('btn_custom');
		
	
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.ajaxFrom');
		echo $this->Html->script('login');
		echo $this->Html->script('userAdd');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('footerFixed'); //フッターをウィンドウの一番下に固定する(現在はcssで実装している)
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script>
		$('.dropdown-toggle').dropdown()
		$('#loginModal').modal()
		$('#signModal').modal()
		
	</script>
</head>
	<body>
		<div id="container">
			<header id="header">
				<div id="navi">
					<div id='link'>
						<!-- 各機能へのリンク -->
						<a clas="home_logo" href="../home/index" style="float:right"><div class="home_logo"></div></a>
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
							<!-- <li style="float:left"><?php echo $this->Html->link('テスト(ﾟﾟ;)',array('controller' => 'users','action'=>'test')); ?></li> -->
							<li style="float:left"><a>Search</a></li>
							<li style="float:left"><a>Gallery</a></li>
							<li style="float:left"><a>About Us</a></li>
						</ul>
						
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
						        	<?php echo $this -> Form -> create('User', array('type' => 'post', 'id'=>'loginForm')); ?>
								    <?php echo $this -> Form -> input('email', array('type' => 'email', 'label' => false, 'id'=>'email', 'class' => 'input_form', 'placeholder' => 'ユーザー名')); ?>
								    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => false, 'id'=>'password', 'class' => 'input_form' , 'placeholder' => 'パスワード' )); ?>
						      </div>
						      <div class="modal-footer">
						      	<?php echo $this -> Form -> submit('Login', array('type' => 'submit', 'class' => 'btn-custom btn-sign')); ?>
						    	<?php echo $this -> Form -> end(); ?>
						      </div>
						    </div><!-- /.modal-content -->
						  </div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div>
					

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
										echo $this->Form->input('name', array(
											'label' => false,
											'type'=>'text',
											'id'=>'name',
											'class'=>'input_form',
											'placeholder' =>'ユーザーID'));
										?>
										<?php 
											echo $this->Form->input('password',array(
												'label' => false,
												'type' => 'password',
												'id'=>'password',
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
												'id'=>'confirm',
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
												'id'=>'email',
												'class'=>'input_form',
												'placeholder' =>'メールアドレス',
												'error' => array(
													'email' => __('※メールアドレスを正しく入力してください。', true),
													'isUnique' => __('※そのメールアドレスは既に使用されています', true)))); 
										?>
									</div>
									<div class="modal-footer">
								      	<?php echo $this ->Form->submit('Sign up', array('type' => 'submit', 'id' => 'form', 'class' => 'btn-custom btn-sign')); ?>
										<?php echo $this->Form->end(); ?>
						      		</div>
							    </div><!-- /.modal-content -->
							  </div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						</div>
						
						<div class="auth">
							<ul style="list-style: none" id="right" style="float: right;">
								<?php if($user == null) {?>
									<a href="#loginModal" data-toggle="modal" class="menu-list" style="float:right">Login</a>
									<a href="#signModal" data-toggle="modal" class="menu-list" style="float:right">Sign up</a>
								<?php } else { ?>
									<li class="dropdown" id="menu-user" style="float:right">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#menu-user">
											<?php echo $user['name']; ?>
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="/users/edit"><i class="glyphicon glyphicon-user"> ユーザー編集</i></a></li> 
											<li><a href="#"><i class="glyphicon glyphicon-star"> お気に入り</i></a></li> 
											<li><a href="#"><i class="glyphicon glyphicon-wrench"> 設定</i></a></li>
											<li class="divider"></li>
											<li><a><i class="glyphicon glyphicon-log-out"></i><?php echo $this->Html->link('ログアウト',array('controller' => 'users','action'=>'logout')); ?></a></li>
										</ul>
									</li>
								<?php }?>
							</ul>
				        </div>
					</div>
				</div>
			</header>
		</div>

		
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