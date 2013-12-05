<?php
/**
 * 
 * 必須パラメータ: User
 * 
 */

$this->Html->css('menu', null, array('inline' => false));
$this->Html->css('dropdown/dropdown', null, array('inline' => false));

$this->Html->script('menu', array('inline' => false));
$this->Html->script('dropdown/dropdown', array('inline' => false));
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
		<ul id="dropdownmenu">
			<li><a href="#">Create</a>
				<ul>
					<li><a href="/blogs/index">日記一覧</a></li>
					<li><a href="#">作品登録</a></li>
					<li><a href="/tags/index">タグ編集</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Search</a>
				<ul>
					<li><a href="/searches/index#">日記検索</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Gallery</a>
				<ul>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="#">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Upload</a>
				<ul>
					<li><a href="/images/index">ここでファック</a></li>
					<li><a href="#">ギャランドゥ</a></li>
					<li><a href="#">ドゥドゥドゥ・デ・ダダダ</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">About us</a>
				<ul>
					<li><a href="#">菅村は</a></li>
					<li><a href="#">まじで</a></li>
					<li><a href="#">くそ</a></li>
				</ul>
			</li>
		</ul>
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
		<!-- <li class="dropdown" id="menu-user">
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
		</li> -->
		<ul id="dropdownmenu">
			<li><a href="#"><?php echo $user['name']; ?></a>
				<ul>
					<li><a href="/users/edit">ユーザー編集</a></li> 
					<li><a href="#">お気に入り</a></li> 
					<li><a href="#">設定</a></li>
					<li><a href="/users/logout">ログアウト</a></li>
				</ul>
			</li>
		</ul>
	<?php endif; ?>
	</ul>
</div><!-- /.navbar -->