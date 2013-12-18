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
					<li><a href="/blogs/index"><i class="fa fa-file-text-o menu"></i>日記一覧</a></li>
					<li><a href="/blogs/add"><i class="fa fa-pencil-square-o menu"></i>日記作成</a></li>
					<li><a href="/products/add"><i class="fa fa-film menu"></i>作品登録</a></li>
					<li><a href="/tags/index"><i class="fa fa-tags menu"></i>タグ編集</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Search</a>
				<ul>
					<li><a href="/searches/index#"><i class="fa fa-search menu"></i>日記検索</a></li>
					<li><a href="#">タグ検索</a></li>
					<li><a href="#">作品検索</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Gallery</a>
				<ul>
					<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
					
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">Upload</a>
				<ul>
					<li><a href="/images/index">Upload</a></li>
				</ul>
			</li>
		</ul>
		<ul id="dropdownmenu">
			<li><a href="#">About us</a>
				<ul>
					<li><a href="#"><i class="fa fa-thumbs-down menu"></i>菅村は</a></li>
					<li><a href="#"><i class="fa fa-thumbs-down menu"></i>まじで</a></li>
					<li><a href="#"><i class="fa fa-thumbs-down menu"></i>くそ<i class="fa fa-thumbs-down"></i></a></li>
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
		<ul id="dropdownmenu">
			<li><a href="#"><?php echo $user['name']; ?></a>
				<ul>
					<li><a href="/users/edit"><i class="fa fa-user menu"></i>ユーザー編集</a></li> 
					<li><a href="#"><i class="fa fa-star-o menu"></i>お気に入り</a></li> 
					<li><a href="#"><i class="fa fa-cog menu"></i>設定</a></li>
					<li><a href="/users/logout"><i class="fa fa-sign-out menu"></i>ログアウト</a></li>
				</ul>
			</li>
		</ul>
	<?php endif; ?>
	</ul>
</div><!-- /.navbar -->