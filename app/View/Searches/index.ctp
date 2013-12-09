<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('colorbox', null, array('inline' => false));
	
	$this->Html->script('prism', array('inline' => false));
	$this->Html->script('liffect', array('inline' => false));
	$this->Html->script('colorbox/jquery.colorbox-min', array('inline' => false));
?>
<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".ajax").colorbox({width:50%});
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
			

</script>

<div id="search">
	<hr>
	 <?php
		 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
		 echo $this->Form->input('Words',array('label' => false, 'name' => 'data[Search][condition]','class' => 'form-control','placeholder' => 'Search here...'));
		 echo $this->Form->submit('検索',array('class' => 'btn-a btn-search'));
		 echo $this->Form->end();
	 ?>
	 
	<hr>
	<div id="result">
	<?php foreach($blogs as $blog) : ?>
		<div class="cont">
			<a class='ajax' href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"></a>
			<span>
				<?php 
					if(mb_strlen($blog['Blog']['title']) <= 7){
						echo $blog['Blog']['title']; 
					} else {
						$len = 22;
						print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
					}
				?>
			</span>
			<hr>
			<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<div>no images</div>
					
					<?php
						// $len = 100;
						// print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
			<?php } ?>
		</div>
	<?php endforeach; ?>
	</div>
	
	
	
	
</div> <!-- END search -->
	
	 
