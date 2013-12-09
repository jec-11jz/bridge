<?php
	$this->extend('/Common/index');
	
	echo $this->Html->css('diary');
?>

<div id="diary">
	<h4>タイトル</h4>
	<h1><?php echo h($blog['Blog']['title']); ?></h1>
	
	<h4>本文</h4>
	<p><?php echo $blog['Blog']['content']; ?></p>
	
	<!-- 作成日 -->
	<p><small>Created: <?php echo $blog['Blog']['created']; ?></small></p>
	
	</div>
<hr />
<a href="/blogs" style="display:block">投稿一覧へ戻る</a>
</div>