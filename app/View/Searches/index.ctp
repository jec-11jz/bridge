<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('colorbox', null, array('inline' => false));
	
	
	$this->Html->script('colorbox/jquery.colorbox-min', array('inline' => false));
?>

<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".ajax").colorbox();
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
	<h1>Search!!!!!!!!（＾ω＾）</h1>
	 <?php
		 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
		 echo $this->Form->input('Words',array('label' => false,'class' => 'form-control'));
		 echo $this->Form->submit('検索',array('class' => 'btn-a btn-search'));
		 echo $this->Form->end();
	 ?>
	 
	 <hr>
	<!-- <table class="table table-hover">
			<?php foreach($blogs as $blog) : ?>
			<tr>
				<td><a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"><?php echo $blog['Blog']['title']; ?>
				<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<div>画像なし</div>
					<?php
						$len = 100;
						print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
				<?php } ?>
				</a></td>
			</tr>
		<?php endforeach; ?>
	</table> -->
	<?php foreach($blogs as $blog) : ?>
		
		<div id="result">
			<a class='ajax' href="/blogs/view/<?php echo $blog['Blog']['id'] ?>">
			<span><?php echo $blog['Blog']['title']; ?></span>
			<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<div>no images</div>
					
					<?php
						// $len = 100;
						// print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
			<?php } ?>
			</a>
		</div>
	<?php endforeach; ?>
	
	
	
</div> <!-- END search -->
	
	 
