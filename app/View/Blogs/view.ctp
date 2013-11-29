<!-- タイトル -->
<h1><?php echo h($blog['Blog']['title']); ?></h1>
<!-- 作成日 -->
<p><small>Created: <?php echo $blog['Blog']['created']; ?></small></p>
<!-- 本文 -->
<p><?php echo $blog['Blog']['content']; ?></p>
<hr />
<?php 
	echo $this->Html->link('投稿一覧へ戻る',
	    array('action' => 'index'));
?>