<?php

	$this->extend('/Common/index');

	echo $this->Html->css('diary');
	echo $this->Html->css('component');

	echo $this->Html->script('masonry.pkgd');
	echo $this->Html->script('imagesloaded');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>
<div id="diary-index">
</div> <!-- #diary-index -->


<script>


	$("window").load(function() {
  		$("#body").removeClass("preload");
	});

	function addMenuEvent() {
		$(".item-button").mouseenter(function() {
			var share_btn = $(this);
			setTimeout(function() {
				container_item = share_btn.parents(".container-item:first");
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
			$(".container-item").css("z-index","500")
			}, 400);
		});
	}
	
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

	var page = 1;
	var count = 50;
	function loadBlogs() {
		$.ajax({
			type: 'GET',
			url: 'http://bridge.com/api/blogs.json?count='+ count +'&page='+ page,
			success: function(data, dataType) {
				blogs = $('#blogTemplate').tmpl(data['response']['blogs']);
				$('#diary-index').append(blogs);
				$('#diary-index').imagesLoaded(function() {
					$('.container-item').removeClass('hidden');
					$('#diary-index').masonry('appended', blogs);
				});
				addMenuEvent();
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
			<a href="/blogs/view/${Blog.id}" class="link"></a>
			{{if UsedBlogImage.length != 0}}
				<a style="background-color: white;width:100%;height100%;">
					<img src="${UsedBlogImage[0].url}" class="diary-pic">
				</a>
			{{else}}
				<div>[no images]</div>
				<div class="text-index" style="width: 220px; height:200px">
					${Blog.content}
				</div>
			{{/if}}
			<!-- 作品アイコン -->
			<div class="product-tag"><i class="fa fa-film"></i></div>
			<a class="item-button"><i class="fa fa-chevron-left"></i></a>
			<div class="item-content">
				<div class="item-top-content">
					<div class="item-top-content-inner">
						<span>
							<h5>${Blog.title}</h5>
						</span>
					</div><!-- item-top content-inner -->
				</div><!-- item-top-content -->
			</div> <!-- item-content -->
		</div> <!-- item -->

		<div class="slide-menu">
			<ul> <!-- サイドメニュー -->
				<li><a href="/blogs/edit/${Blog.id}" class="fa fa-pencil-square-o"></a></li>
				<li><a href="/blogs/view/${Blog.id}" class="popout-menu-item"><i class="fa fa-eye"></i></li>
				<li><a href="#" class="popout-menu-item"><i class="fa fa-star"></i></a></li>
				<li><a href="/blogs/delete/${Blog.id}" class="fa fa-trash-o"></a></li>
			</ul>
		</div>
	</div> <!-- container-item -->
</script>
