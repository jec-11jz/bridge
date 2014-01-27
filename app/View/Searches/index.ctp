<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('automatic/style', null, array('inline' => false));
	echo $this->Html->css('tag/tags_custom');
	
	$this->Html->script('automatic/jquery.montage', array('inline' => false));
	echo $this->Html->script('tag/tags');
	echo $this->Html->script('masonry.pkgd');
	echo $this->Html->script('imagesloaded');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<div id="search">
	<hr>
	<form method="get" action="/searches/index">
		<input name="keywords" id="keywords" class="form-control" placeholder='Search  here...'>
		<input type="submit" value="Search" class="btn-a search" id="btn-search">
		<div id="search-custom">
			Not<input name="not-keywords" id="not-keywords" class="form-control tags" placeholder='Search here...'>
			And<input name="and-keywords" id="and-keywords" class="form-control tags" placeholder='Search here...'>
			Or<input name="or-keywords" id="or-keywords" class="form-control tags" placeholder='Search here...'>
		</div>
	</form>
</div> <!-- END search -->
<hr>
<div id="search-result">
	<div id="search-blogs-result"></div>
	<div id="search-products-result"></div>
</div>

<script>
$(function() {
	// get tags from DB
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			//tagbox
			$('.tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(tags){
			console.log('tags error');
		}
	});

	page = 1;
	var count = 25;
	var keywords = $('#keywords').val();
	var key_not = $('#not-keywords').val();
	var key_and = $('#and-keywords').val();
	var key_or = $('#or-keywords').val();
	function loadBlogs(page, count, keywords, key_not, key_and, key_or) {
		$.ajax({
			type: 'GET',
			url: '/api/searches/search.json',
			data: {'count': count, 'page': page, 'keywords': keywords, 'key_not': key_not, 'key_and': key_and, 'key_or': key_or},
			success: function(data, dataType) {
				console.log(data);
				$('.cont').remove();
				// products
				products = $('#js-search-products').tmpl(data['response']['products']);
				$('#search-products-result').append(products);
				// blogs
				blogs = $('#js-search-blogs').tmpl(data['response']['blogs']);
				$('#search-blogs-result').append(blogs);
				// loadImage
				$('#search-result').imagesLoaded(function() {
					$('.cont').removeClass('hidden');
					$('#search-result').masonry('appended', products);
					$('#search-result').masonry('appended', blogs);
				});
				page++;
			},
			error: function(xhr, xhrStatus) {
				console.log('load error');
			}
		});
	}
	$(window).on('scroll', function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
			loadBlogs(
				page, 
				count, 
				$('#keywords').val(), 
				$('#not-keywords').val(), 
				$('#and-keywords').val(), 
				$('#or-keywords').val()
			);
			$('#search-result').imagesLoaded(function() {
				$('.cont').removeClass('hidden');
				$('#search-result').masonry('appended', products);
				$('#search-result').masonry('appended', blogs);
			});
		}
	});
	loadBlogs(page, count, keywords, key_not, key_and, key_or);
	var diary = $('#search-result');
	diary.masonry({
    	itemSelector: '.cont',
     	isAnimated: true,
		isFitWidth: true,
		columnWidth: 1
	});
	// setTimeout("loadBlogs();", 2000);

	// search
	$("#btn-search").click(function(){
		console.log(keywords);
		var diary = $('#search-result');
		diary.masonry('unbindResize');
		loadBlogs(
			1, 
			count, 
			$('#keywords').val(), 
			$('#not-keywords').val(), 
			$('#and-keywords').val(), 
			$('#or-keywords').val()
		);
		$('#search-result').imagesLoaded(function() {
			$('#search-result').masonry();
		});
	});
});
</script>
<!-- product -->
<script id="js-search-products" type="text/x-jquery-tmpl">
	<div class="cont hidden" style="float:left">
		<div class="cont-pic">
			<a href="/products/view/${Product.id}" class="link"></a>
			{{if Product.image_url != ""}}
				<img src="${Product.image_url}" data-original="${Product.image_url}" class="cover" width="220px" height="auto">
			{{else}}
				<div style="width: 220px;height:220px">${Product.name.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</div>
				${Product.outline.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,99) +""}
			{{/if}}
			<div class="cont-info">
				<div class="cont-title">
					<p>${Product.name.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</p>
				</div>
				<div class="cont-detail"></div>
				<div class="cont-author"></div>
			</div>
		</div>
	</div>
</script>
<!-- blog -->
<script id="js-search-blogs" type="text/x-jquery-tmpl">
	<div class="cont hidden" style="float:left">
		<div class="cont-pic">
			<a href="/blogs/view/${Blog.id}" class="link"></a>
			{{if UsedBlogImage.length != 0}}
				<img src="${UsedBlogImage[0].url}" data-original="${UsedBlogImage[0].url}" class="cover" width="220px" height="auto">
			{{else}}
				<div style="width: 220px;height:220px">${Blog.title}</div>
				${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,99) +""}
			{{/if}}
			<div class="cont-info">
				<div class="cont-title">
					<p>${Blog.title.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</p>
				</div>
				<div class="cont-detail"></div>
				<div class="cont-author"><p>Author: ${User.name}</p></div>
			</div>
		</div>
	</div>
</script>
