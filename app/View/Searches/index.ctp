<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('automatic/style', null, array('inline' => false));
	
	// $this->Html->script('liffect', array('inline' => false));
	$this->Html->script('automatic/jquery.montage', array('inline' => false));
	echo $this->Html->script('masonry.pkgd');
	echo $this->Html->script('imagesloaded');
	echo $this->Html->script('jquery.lazyload');
	
?>

<div id="search">
	<hr>
	 <?php
		 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
		 echo $this->Form->input('Words',array('label' => false, 'name' => 'data[Search][condition]','class' => 'form-control','placeholder' => 'Search here...'));
		 echo $this->Form->submit('検索',array('class' => 'btn-a btn-search'));
		 echo $this->Form->end();
	 ?>
</div> <!-- END search -->
<hr>

	
<div id="search-result">
<?php foreach($blogs as $blog) : ?>
	<div class="cont" style="float:left">
		<div class="cont-pic">
			<!-- <div class="cont1"> -->
				<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" class="link"></a>
			    <?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
				<img  src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" data-original="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" class="cover" width="220px" height="auto">
				<?php } else { ?>
					<div style="width: 220px;height:220px"><?php echo $blog['Blog']['title']?></div>
					<?php
						$len = 100;
						print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
				<?php } ?>
				
			<!-- </div> -->
		     <div class="cont-info">
			     <div class="cont-title">
			     	<p>
			        	<?php 
							if(mb_strlen($blog['Blog']['title']) <= 7){
								echo $blog['Blog']['title']; 
							} else {
								$len = 27;
								print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
							}
						?>
		        	</p>
			     </div>
			     <div class="cont-detail">
			     </div>
		    </div>
		</div>
	</div>
		<!-- <div class="cont">
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
		</div> -->
<?php endforeach; ?>
</div>



<script>


    var $diary = $('#search-result');

	$(function(){
		
		// $diary.imagesLoaded(function(){
			$diary.masonry({
	      		itemSelector: '.cont',
	      		isAnimated: true,
				isFitWidth: true
	    	});
		// });
		
    });



	$(window).on("scroll", function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
			var elements = $("#search-result").masonry('getItem');
			//$("#search-result").masonry('appended', elements);
			// $("#search-result").masonry();
		}
	});
	// $(document).ready(function(){  
	// 	$('img').lazyload({
	//         effect: 'fadeIn',
	//         effectspeed: 2000
	//   });
	// });

    
</script>  
	
	 
