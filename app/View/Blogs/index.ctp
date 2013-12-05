<?php
		echo $this->Html->css('diary');
		echo $this->Html->css('swipebox/style');
		
		$this->extend('/Common/index');
		
		echo $this->Html->script('swipebox/jquery.swipebox');
		echo $this->Html->script('swipebox/jquery-2.0.3.min');
?>
<a href="/blogs/add" class="btn-a">新規作成</a>



<div id="diary-index">
	<?php foreach($blogs as $blog) : ?>
	<div class="cont" style="float:left">
		
		<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" class="title" style="text-align: right"><?php echo $blog['Blog']['title']; ?></a>
		<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
			<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"><img  src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto"></a>
		<?php } else { ?>
			<div>[no images]</div>
			<?php
				// $len = 100;
				// print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
			?>
		<?php } ?>
		<a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn-a btn-size-s" style="float:right"> 編集</a>
		<h5><?php echo $blog['Blog']['created']; ?></h5>
		<span><?php echo $users['User']['name']; ?></span>
		<?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '本当に削除しますか？')); ?>
	</div>
	<?php endforeach; ?>
</div>

