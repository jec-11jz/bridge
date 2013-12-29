<?php
		
		echo $this->Html->css('component');

		$this->extend('/Common/index');

		echo $this->Html->css('diary');

		echo $this->Html->script('masonry.pkgd');
		echo $this->Html->script('imagesloaded');
		// echo $this->Html->script('AnimOnScroll');
		// echo $this->Html->script('classie');

		//ini_set('memory_limit', '64MB');
		
?>





<div id="diary-index">
	<?php foreach($blogs as $blog) : ?>
		<div class="container-item">
			<div class="item">
				<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="220px" height="auto">
					<?php } else { ?>
					<div>[no images]</div>
					<div style="width: 220px; height:200px">
						<?php
							$len = 100;
							print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
						?>
					</div>
				<?php } ?>
				<div class="item-overlay">
					<a href="#" class="item-button share share-btn"><i class="fa fa-bars"></i></a>
					<div class="sale-tag"><i class="fa fa-film"></i></div>
				</div>
				<div class="item-content">
					<div class="item-top-content">
						<div class="item-top-content-inner">
							<div class="item-top-title">
								<h5>
									<?php 
									if(mb_strlen($blog['Blog']['title']) <= 7){
										echo $blog['Blog']['title']; 
									} else {
										$len = 30;
										print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
									}
									?>
								</h5>
							</div> <!-- item-top-title -->
						</div>	<!-- item-top content-inner -->
					</div>　<!-- item-top-content -->
					<div class="item-add-content">
						<div class="item-add-content-inner">
							<a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn buy expand fa fa-pencil-square-o">Edit</a>
						</div>
					</div>
				</div> <!-- item-content -->
			</div> <!-- item -->

			<div class="item-menu popout-menu">
				<ul> <!-- サイドメニュー -->
					<li><a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" class="popout-menu-item"><i class="fa fa-eye"></i></li>
					<li><a href="#" class="popout-menu-item"><i class="fa fa-star"></i></a></li>
					<li><?php echo $this->Form->postLink("", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></li>
				</ul>
			</div>
		</div> <!-- container-item -->
	<?php endforeach; ?>
</div> <!-- #diary-index -->

		



<script>

		$("window").load(function() {
  			$("#body").removeClass("preload");
		});

		$(".share-btn").mouseenter(function() {
			var share_btn = $(this);
			setTimeout(function() {
			//$(".item-menu").addClass("visible")
			share_btn.parents(".container-item:first").find(".item-menu:first").addClass("visible");
			}, 400);
		});
		$(".share-btn").mouseleave(function() {
			setTimeout(function() {
			// share_btn.parents(".container-item:first").find(".item-menu:first").removeClass("visible");
			$(".item-menu").removeClass("visible")
			}, 400);
		});
		$(".item-menu").hover(function() {
			share_btn.parents(".container-item:first").find(".item-menu:first").addClass("visible");
			// $(".item-menu").addClass("visible")
		});
		$(".item-menu").mouseleave(function() {
			setTimeout(function() {
			// share_btn.parents(".container-item:first").find(".item-menu:first").removeClass("visible");
			$(".item-menu").removeClass("visible")
			}, 400);
		});
		$(".container-item").hover(function() {
			setTimeout(function() {
			$(".container-item").css("z-index","1000")
			}, 400);
		});

	
	//画像読み込み後にレイアウト
	// var $diary = $('#diary-index');
	//レイアウト後に画像読み込み
	var $diary = $('#diary-index').masonry();

	
	$(function(){

		$diary.imagesLoaded(function(){
			$diary.masonry({
	      		itemSelector: '.cont',
	      		isAnimated: true,
				isFitWidth: true
	    	});
		});

    });
</script>

