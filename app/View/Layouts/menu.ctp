<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bridge</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('menu');
		echo $this->Html->css('fonts');
		echo $this->Html->css('btn_custom');
		echo $this->Html->css('modal/modal');
		echo $this->Html->css('modal/modal_custom');
	
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('menu');
		echo $this->Html->script('footerFixed'); //フッターをウィンドウの一番下に固定する(現在はcssで実装している)

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script>
		$('.dropdown-toggle').dropdown()
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
							
							<li class="dropdown" id="menu11" style="float:left">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#menu11">
									Create
								</a>
								<ul class="dropdown-menu">
									<li><a href="/blogs/index">日記作成</a></li>
									<li><a href="#">作品登録</a></li>
									<li><a href="#">タグ編集</a></li>
								</ul>
							</li>
							
							
							<li style="float:left"><?php echo $this->Html->link('テスト(ﾟﾟ;)',array('controller' => 'users','action'=>'test')); ?></li>
						</ul>
						<!--　モーダルウィンドウ -->
						<section class="semantic-content" id="modal-text" tabindex="-1"role="dialog" aria-labelledby="modal-label" aria-hidden="true">
					 	
						    <div class="modal-inner">
						        <header id="modal-label">Login</header>
						        <!-- モーダルウィンドウの記述 -->
						        <div class="modal-content">
									<?php echo $this -> Form -> create('User', array('type' => 'post', 'action' => 'login')); ?>
								    <?php echo $this -> Form -> input('email', array('type' => 'email', 'label' => false, 'class' => 'input_form', 'placeholder' => 'ユーザー名')); ?>
								    <?php echo $this -> Form -> input('password', array('type' => 'password', 'label' => false, 'class' => 'input_form' , 'placeholder' => 'パスワード' )); ?>
						        </div>
						        <footer class="modal-footer">
						        	<?php echo $this -> Form-> submit('Login', array('type' => 'submit', 'class' => 'btn-custom btn-sign')); ?>
							    	<?php echo $this -> Form -> end(); ?>
						        </footer>
						    </div>
						 
						    <a href="#!" class="modal-close" title="Close this modal"
						        data-dismiss="modal">×</a>
						</section>
						
						<!-- モーダルウィンドウ 登録画面 -->
					    <section class="semantic-content" id="modal-text2" tabindex="-1"role="dialog" aria-labelledby="modal-label" aria-hidden="true">
					 	
						    <div class="modal-inner">
						        <header id="modal-label">Sign up</header>
						        <!-- モーダルウィンドウの記述 -->
						        <div class="modal-content">
						        	<?php echo $this->Form->create('User', array( 'type'=>'post', 'action'=>'add')); ?>
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
						        <footer class="modal-footer">
						        	<?php echo $this ->Form->submit('Sign up', array('type' => 'submit', 'class' => 'btn-custom btn-sign')); ?>
									<?php echo $this->Form->end(); ?>
						        </footer>
						    </div>
						    <a href="#!" class="modal-close" title="Close this modal"data-dismiss="modal">×</a>
						</section>
						<div class="auth">
							<ul style="list-style: none" id="right" style="float: right;">
								<?php if($user == null) {?>
									<a href="#modal-text" style="float:right">Login</a>
									<a href="#modal-text2" style="float:right">Sign up</a>
								<?php } else { ?>
									<li class="dropdown" id="menu1" style="float:right">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
											<?php echo $user['name']; ?>
										</a>
										<ul class="dropdown-menu">
											<li><a href="/users/edit">ユーザー編集</a></li>
											<li><a href="#">お気に入りリスト</a></li>
											<li><a href="#">設定</a></li>
											<li class="divider"></li>
											<li style="float:left"><?php echo $this->Html->link('ログアウト',array('controller' => 'users','action'=>'logout')); ?></li>
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
		
		<?php
			echo $this->Html->script('ModalWindowEffects/cssParser');
			echo $this->Html->script('ModalWindowEffects/css-filters-polyfill');
		?>
	</body>
</html>