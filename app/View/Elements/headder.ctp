<?php
/**
 * 
 * 必須パラメータ: User
 * 
 */

$this->Html->css('menu', null, array('inline' => false));

$this->Html->script('menu', array('inline' => false));
$this->Html->script('dropdown/modernizr.custom.79639', array('inline' => false));
?>

<div class="navbar navbar-fixed-top" role="navigation">
	<!-- 各機能へのリンク -->
	<div class="navbar-header">
	<?php
		echo $this->Html->link(
			$this->Html->image('Bridge_logo_best.png', array('alt' => 'Bridge')),
			'/',
			array('escape' => false, 'class' => 'nav-brand')
		);
	?>
	</div>
	<ul class="nav navbar-nav">
		<div id="dd" class="wrapper-dropdown-5 menu-create" tabindex="1">
			<a href="/home/create" class="link"></a>
			<p><i class="fa fa-edit"></i> Create</p>
		</div>

		<div id="dd" class="wrapper-dropdown-5 menu-search" tabindex="1">
			<a href="/searches/index" class="link"></a>
			<p><i class="fa fa-search"></i> Search</p>			
		</div>

		<div id="dd" class="wrapper-dropdown-5 menu-view" tabindex="1">
			<a href="/home/mypage" class="link"></a>
			<p><i class="fa fa-desktop"></i> My page</p>
		</div>
		

	</ul>
	
	<ul class="nav navbar-nav navbar-right">
	<?php if ($user == null) : ?>
		<div id="dd" class="wrapper-dropdown-5" tabindex="1">
			<a href="#" data-target="#signModal" data-toggle="modal" class="link"></a>
			<p>Sign up</p>
		</div>
		<div id="dd" class="wrapper-dropdown-5" tabindex="1">
			<a href="#" data-target="#loginModal" data-toggle="modal" class="link"></a>
			<p>Login</p>
		</div>
	<?php else: ?>
		<div id="dd" class="wrapper-dropdown-5 user" tabindex="1"><p><?php echo $user['name']; ?></p>
			<ul class="dropdown">
				<li><a href="/home/mypage"><i class="fa fa-user menu"></i>ユーザ編集</a></li> 
					<li><a href="#"><i class="fa fa-star-o menu"></i>お気に入り</a></li> 
					<li><a href="#"><i class="fa fa-cog menu"></i> 設　定　</a></li>
					<li><a href="/users/logout"><i class="fa fa-sign-out menu"></i>ログアウト</a></li>
			</ul>
		</div>
	<?php endif; ?>
	</ul>
</div><!-- /.navbar -->