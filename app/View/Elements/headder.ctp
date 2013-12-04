<?php
/**
 * 
 * 必須パラメータ: User
 * 
 */

$this->Html->css('menu', null, array('inline' => false));
$this->Html->css('dropdown/style4', null, array('inline' => false));

$this->Html->script('menu', array('inline' => false));
$this->Html->script('dropdown/jquery.dropdown', array('inline' => false));
$this->Html->script('dropdown/modernizr.custom.63321', array('inline' => false));
$this->Html->script('dropdown/jump', array('inline' => false));
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
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#menu-create">
				Create
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="/blogs/index"><span class="glyphicon glyphicon-pencil"></i>　日記作成</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-film"></i>　作品登録</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-tags"></i>　タグ編集</a></li>
			</ul>
		</li>
		
		<li><a href="/searches/index">Search</a></li>
		<li><a href="#">Gallery</a></li>
		<li><a href="/images/index">Upload</a></li>
		<li><a href="#">About Us</a></li>
		<!-- <li>
			<div class="fleft">
				<select onchange="locations.href=this.value" name="select"  id="cd-dropdown" class="cd-select select">
					<option value="-1" selected>Create</option>
					<option value="../../blogs/index">Diary</option>
					<option value="../../blogs/index">Movies</option>
					<option value="../../blogs/index">Tags</option>
					<option value="4">ABE</option>
				</select>
			</div>
		</li> -->
	</ul>
	<ul class="nav navbar-nav navbar-right">
	<?php if ($user == null) : ?>
		<li>
			<a href="#" data-target="#signModal" data-toggle="modal" class="menu-list">Sign up</a>
		</li>
		<li>
			<a href="#" data-target="#loginModal" data-toggle="modal" class="menu-list list-login">Login</a>
		</li>
	<?php else: ?>
		<li class="dropdown" id="menu-user">
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
	<?php endif; ?>
	</ul>
</div><!-- /.navbar -->