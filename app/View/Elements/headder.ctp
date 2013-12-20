<?php
/**
 * 
 * 必須パラメータ: User
 * 
 */

$this->Html->css('menu', null, array('inline' => false));
$this->Html->css('dropdown/style', null, array('inline' => false));

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
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p>Create</p>
			<ul class="dropdown">
				<li><a href="/blogs/index"><i class="fa fa-file-text-o menu"></i>日記一覧</a></li>
				<li><a href="/blogs/add"><i class="fa fa-pencil-square-o menu"></i>日記作成</a></li>
				<li><a href="/products/add"><i class="fa fa-film menu"></i>作品登録</a></li>
				<li><a href="/tags/index"><i class="fa fa-tags menu"></i>タグ編集</a></li>
			</ul>
		</div>
		
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p>Search</p>			
			<ul class="dropdown">
				<li><a href="/searches/index"><i class="fa fa-search menu"></i>日記検索</a></li>
				<li><a href="#"><i class="fa fa-search menu"></i>タグ検索</a></li>
				<li><a href="#"><i class="fa fa-search menu"></i>作品検索</a></li>
				<li><a href="/searches/test">テスト</a></li>
			</ul>
		</div>
		
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p>Gallery</p>
			<ul class="dropdown">
				<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
				<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
				<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
				<li><a href="/home/gallery">ｷﾞｬﾗﾝﾄﾞｩ</a></li>
			</ul>
		</div>
		
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p>Upload</p>
			<ul class="dropdown">
				<li><a href="/images/index">Upload</a></li>
				<li><a href="http://bridge/js/kcfinder/browse.php?type=images&dir=images">BlogsUp</li>
			</ul>
		</div>
	
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p>About us</p>
			<ul class="dropdown">
				<li><a href="#"><i class="fa fa-thumbs-down menu"></i>菅村は</a></li>
				<li><a href="#"><i class="fa fa-thumbs-down menu"></i>まじで</a></li>
				<li><a href="#"><i class="fa fa-thumbs-down menu"></i>くそ<i class="fa fa-thumbs-down"></i></a></li>
			</ul>
		</div>
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
		<div id="dd" class="wrapper-dropdown-5" tabindex="1"><p><?php echo $user['name']; ?></p>
			<ul class="dropdown">
				<li><a href="/users/edit"><i class="fa fa-user menu"></i>ユーザー編集</a></li> 
					<li><a href="#"><i class="fa fa-star-o menu"></i>お気に入り</a></li> 
					<li><a href="#"><i class="fa fa-cog menu"></i>設定</a></li>
					<li><a href="/users/logout"><i class="fa fa-sign-out menu"></i>ログアウト</a></li>
			</ul>
		</div>
	<?php endif; ?>
	</ul>
</div><!-- /.navbar -->