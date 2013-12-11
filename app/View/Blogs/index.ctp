<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
		
		
?>

<script>
    $(document).ready(function(){  
        //マウスオーバー時に残りを表示  
        $('.boxgrid.caption').hover(function(){  
            $(".cover", this).stop().animate({top:'140px'},{queue:false,duration:130});  
        }, function() {  
            $(".cover", this).stop().animate({top:'180px'},{queue:false,duration:130});  
        });  
    });  
</script>


<div id="diary-index">
	<?php foreach($blogs as $blog) : ?>
	<div class="cont" style="float:left">
		
		<div class="boxgrid caption">
			<div class="cont1">
				<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>">
			    <?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
				<img  src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<div>[no images]</div>
					<?php
						$len = 100;
						print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
				<?php } ?>
			</div>
		    <div class="cover boxcaption">
		        <a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" style="display: block">
		        	<?php 
						if(mb_strlen($blog['Blog']['title']) <= 7){
							echo $blog['Blog']['title']; 
						} else {
							$len = 22;
							print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
						}
					?>
	        	</a>
	        	<a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn-a btn-size-s"><i class="fa fa-pencil-square-o"></i> Edit</a>	
		        <?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '削除しますか？', 'class'=>'btn-a fa fa-trash-o')); ?>
		    </div>
		</div>
			
				<!-- <h5><?php echo $blog['Blog']['created']; ?></h5> -->
				
		
	</div>
	<?php endforeach; ?>
</div>




