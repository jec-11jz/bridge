<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
		
		
?>

<script>
</script>
<a href="/blogs/add" class="btn-a">新規作成</a>



<div id="diary-index">
	<?php foreach($blogs as $blog) : ?>
	<div class="cont" style="float:left">
		<div class="cont1">
			<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" class="link"></a>
			<h5>
				<?php 
					if(mb_strlen($blog['Blog']['title']) <= 7){
						echo $blog['Blog']['title']; 
					} else {
						$len = 22;
						print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
					}
				?>
				
			</h5>
			<hr>
			<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
				<a href="#" data-target="#myToggle" class="hcaption" ><img  src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto"></a>
				<div id="myToggle" class="fade">
				  <h5>Cupcakes</h5>
				</div>
			<?php } else { ?>
				<div>[no images]</div>
				<?php
					// $len = 100;
					// print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
				?>
			<?php } ?>
		
			<div class="cont2"> 
				<a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn-a btn-size-s" style="float:right"> 編集</a>
				<h5><?php echo $blog['Blog']['created']; ?></h5>
				<span><?php echo $users['User']['name']; ?></span>
				<?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '削除しますか？')); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>




