<?php
	echo $this->Html->css('component');

	$this->extend('/Common/index');

	echo $this->Html->css('diary');

	echo $this->Html->script('masonry.pkgd');
	echo $this->Html->script('imagesloaded');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
	$this->Html->script('jquery.inview.min', array('inline' => false));
?>
<div id="diary-index">
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
	$(window).on('scroll', function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
			loadBlogs();
		}
	});

	$('#diary-index:last-child').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
		loadBlogs();
	});


	var page = 1;
	function loadBlogs() {
		$.ajax({
			type: 'GET',
			url: 'http://bridge.com/blogs/index/page:'+ page +'.json',
			success: function(data, dataType) {
				blogs = $('#blogTemplate').tmpl(data['blogs']);
				$('#diary-index').append(blogs);
				$('#diary-index').imagesLoaded(function() {
					$('.container-item').removeClass('hidden');
					$('#diary-index').masonry('appended', blogs);
				});
				page++;
			}
		});
	}
	$(function(){
		var diary = $('#diary-index');
		diary.masonry({
	    	itemSelector: '.container-item',
	     	isAnimated: true,
			isFitWidth: true,
			columnWidth: 1
		});
		loadBlogs();
		// setTimeout("loadBlogs();", 2000);
	});
</script>

<script id="blogTemplate" type="text/x-jquery-tmpl">
	<div class="container-item hidden">
		<div class="item">
			{{if UsedBlogImage.length != 0}}
				<img src="${UsedBlogImage[0].url}">
			{{else}}
				<div>[no images]</div>
				<div style="width: 220px; height:200px">
					${Blog.content}
				</div>
			{{/if}}
			<div class="item-overlay">
				<a href="#" class="item-button share share-btn"><i class="fa fa-bars"></i></a>
				<div class="sale-tag"><i class="fa fa-film"></i></div>
			</div>
			<div class="item-content">
				<div class="item-top-content">
					<div class="item-top-content-inner">
						<div class="item-top-title">
							<h5>${Blog.title}</h5>
						</div> <!-- item-top-title -->
					</div>	<!-- item-top content-inner -->
				</div><!-- item-top-content -->
				<div class="item-add-content">
					<div class="item-add-content-inner">
						<a href="/blogs/edit/${Blog.id}" class="btn buy expand fa fa-pencil-square-o">Edit</a>
					</div>
				</div>
			</div> <!-- item-content -->
		</div> <!-- item -->

		<div class="item-menu popout-menu">
			<ul> <!-- サイドメニュー -->
				<li><a href="/blogs/view/${Blog.id}" class="popout-menu-item"><i class="fa fa-eye"></i></li>
				<li><a href="#" class="popout-menu-item"><i class="fa fa-star"></i></a></li>
				<li>削除かなにかだった</li>
			</ul>
		</div>
	</div> <!-- container-item -->
</script>
