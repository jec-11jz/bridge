<?php
		
		$this->extend('/Common/index');

		echo $this->Html->css('diary');
		echo $this->Html->css('component');

		echo $this->Html->script('masonry.pkgd');
		echo $this->Html->script('imagesloaded');

		//ini_set('memory_limit', '64MB');
		
?>





<div id="diary-index">
	<?php foreach($blogs as $blog) : ?>
		<div class="container-item">
			<div class="item">
				<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" class="link"></a>
				<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<a style="background-color: white;width:100%;height100%;"><img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" class="diary-pic" width="220px" height="auto"></a>
					<?php } else { ?>
					<div>[no images]</div>
					<div class="text-index" style="width: 220px; height:200px">
						<?php
							$len = 100;
							print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
						?>
					</div>
				<?php } ?>
				<!-- 作品アイコン -->
				<div class="product-tag"><i class="fa fa-film"></i></div>
				<a class="item-button"><i class="fa fa-chevron-left"></i></a>
				<div class="item-content">
					<div class="item-top-content">
						<div class="item-top-content-inner">
							<span>
								<?php 
								if(mb_strlen($blog['Blog']['title']) <= 7){
									echo $blog['Blog']['title']; 
								} else {
									$len = 30;
									print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
								}
								?>
							</span>
						</div>	<!-- item-top content-inner -->
					</div>　<!-- item-top-content -->
				</div> <!-- item-content-->
			</div> <!-- item -->
			<div class="slide-menu">
				<ul> <!-- サイドメニュー -->
					<li><a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="fa fa-pencil-square-o"></a></li>
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

		$(".item-button").mouseenter(function() {
			var share_btn = $(this);
			setTimeout(function() {
			container_item = share_btn.parents(".container-item:first");
			container_item.css("z-index: 1000");
			container_item.find("*").map(function() {
				$(this).css("z-index: 1000");
			});
			share_btn.parents(".container-item:first").find(".slide-menu:first").addClass("visible");
			}, 400);
		});
		$(".item-button").mouseleave(function() {
			setTimeout(function() {
			$(".slide-menu").removeClass("visible")
			}, 400);
		});
		$(".slide-menu").hover(function() {
			share_btn.parents(".container-item:first").find(".slide-menu:first").addClass("visible");
		});
		$(".slide-menu").mouseleave(function() {
			setTimeout(function() {
			$(".slide-menu").removeClass("visible")
			}, 400);
		});
		$(".container-item").hover(function() {
			setTimeout(function() {
			//$(".container-item").css("z-index","500")
			}, 400);
		});

	
	//画像読み込み後にレイアウト
	// var $diary = $('#diary-index');
	//レイアウト後に画像読み込み
	var $diary = $('#diary-index').masonry();

	
	$(function(){
		$diary.imagesLoaded(function(){
			$diary.masonry({
	      		itemSelector: '.conteiner-item',
	      		isAnimated: true,
				isFitWidth: true
	    	});
		});
    });
	// $(document).ready(
	// 	function(){
	// 		$(".container-item").hover(function(){
	// 	    $(".item").fadeTo(100, 0.8); // マウスオーバー時にmormal速度で、透明度を60%にする
	// 	},function(){
	// 		$(".item").fadeTo(100, 1.0); // マウスアウト時にmormal速度で、透明度を100%に戻す
	// 	});
	// });
</script>

