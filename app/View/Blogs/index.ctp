<?php

	$this->extend('/Common/index');

	$this->Html->css('mypage', null, array('inline' => false));
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('diary', null, array('inline' => false));

	$this->Html->script('masonry.pkgd', array('inline' => false));
	$this->Html->script('imagesloaded', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<script>

	$("window").load(function() {
  		$("#body").removeClass("preload");
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

	var page = 1;
	var count = 25;
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
	<div class="cont container-item hidden">
		<div class="div-decoration-blogs">
			<span>Blog</span>
		</div>
		<div class="cont-pic">
			<a href="/blogs/view/${Blog.id}" class="link"></a>
			{{if UsedBlogImage.length != 0}}
					<img src="${UsedBlogImage[0].url}" class="diary-pic">
				</a>
			{{else}}
				<div class="div-noimage" style="width: 220px; height:200px">
					<i class="fa fa-camera-retro"></i>
					<p>No image</p>

					<div class="div-noimage-outline">
						${Blog.content}
					</div>
					
				</div>
			{{/if}}
		</div> <!-- item -->

	</div> <!-- container-item -->
</script>

<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($loginInformation['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		<div class="header-user">
			<span><?php echo h($loginInformation['User']['name']); ?></span>
		</div>
		<div class="header-buttons">
			<div class="links-div div-fav">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav blogs</span>
				</div>
			</div>
		
			<div class="links-div div-products">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav products</span>
				</div>
			</div>
		
			
			<div class="links-div div-blogs div-checked">
				<a class="div-link" href="/blogs/index"></a>
				<div class="div-left">
					<i class="fa fa-book"></i>
				</div>
				<div class="div-right">
					<span>My blogs</span>
				</div>
			</div>
		
			<div class="links-div div-temp">
				<a class="div-link" href="/templates/index"></a>
				<div class="div-left">
					<i class="fa fa-th-list"></i>
				</div>
				<div class="div-right">
					<span>Template</span>
				</div>
			</div>
		
			<div class="links-div div-image">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>

			<div class="links-div div-edit">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>My Edit</span>
				</div>
			</div>
		</div>
	</div><!-- form-header -->

	<div class="form-body">
		<div id="diary-index"></div>
	</div>
</div>


