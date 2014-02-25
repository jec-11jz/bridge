<?php

	$this->extend('/Common/index');

	$this->Html->css('mypage', null, array('inline' => false));
	$this->Html->css('searches', null, array('inline' => false));

	$this->Html->script('masonry.pkgd', array('inline' => false));
	$this->Html->script('imagesloaded', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<script>


	$("window").load(function() {
  		$("#body").removeClass("preload");
	});

	function addMenuEvent() {
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
	var count = 25;
	var sort = $('#select-sort').val();
	function loadBlogs() {
		$.ajax({
			type: 'GET',
			url: '/api/blogs.json?count='+ count +'&page='+ page + '&sort='+ sort,
			success: function(data, dataType) {
				blogs = $('#blogTemplate').tmpl(data['response']['blogs']);
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
	
	// change sort
	$('#select-sort').change(function(){
		sort = $('#select-sort').val();
		loadBlogs();
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
				<img src="${UsedBlogImage[0].url}" data-original="${UsedBlogImage[0].url}" class="cover" width="220px" height="auto">
			{{else}}
			<div class="div-noimage" style="width: 220px; height:220px">
				<i class="fa fa-camera-retro"></i>
				<p>No image</p>

				<div class="div-noimage-outline">
					${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,150) +"..."}
				</div>
			</div>
			{{/if}}
			<div class="cont-info">
				<p>${Blog.title.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</p>
			</div>
		</div> <!-- item -->

	</div> <!-- container-item -->
</script>

<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($user_info['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		<div class="header-user">
			<div class="user-potision">
				<div class="div-user-image">
					<a href="/users/mypage" class="link"></a>
					<img id="user-img" class="user-image" src="<?php echo h($user_info['User']['users_image']) ;?>" >
				</div>
				<div class="div-user-name">
					<span class="user-nickname"><?php echo h($user_info['User']['nickname']); ?></span>
					<span class="user-name">ID: <?php echo h($user_info['User']['name']); ?></span>
				</div>
			</div>
		</div><!-- header-user -->
		<div class="header-buttons">
			<div class="links-div div-fav">
				<a class="div-link" href="/users/mypage"></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav blogs</span>
				</div>
			</div>
		
			<div class="links-div div-products">
				<a class="div-link" href="/users/mypage"></a>
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
				<a class="div-link" href="/users/edit"></a>
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
		<div class="div-sort">
			<span>並び替え：</span>
		 	<select id="select-sort" class="sort-list">
			    <option value="created_DESC" selected="selected">新着順</option>
			    <option value="created_ASC">古い順</option>
			    <option value="access_count_DESC">人気順</option>
			    <option value="access_count_ASC">人気がない順</option>
		 	</select>
		</div><!-- sort -->
		<div id="diary-index"></div>
		
	</div>
</div>


