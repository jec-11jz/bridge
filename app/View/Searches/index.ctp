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
		<input name="keywords" id="keywords" class="form-control" placeholder='Search from here...'>
		<input type="submit" value="Search" class="btn-a search" id="btn-search">
		<div id="search-custom">
			Not<input name="not-keywords" id="not-keywords" class="form-control tags" placeholder='Search here...'>
			And<input name="and-keywords" id="and-keywords" class="form-control tags" placeholder='Search here...'>
			Or<input name="or-keywords" id="or-keywords" class="form-control tags" placeholder='Search here...'>
		</div>
	</form>
</div> <!-- END search -->
<hr>
<div id="search-result"></div>

<script>
$(function() {
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
			url: '/api/blogs.json?count='+ count +'&page='+ page,
			success: function(data, dataType) {
				blogs = $('#searchTemplate').tmpl(data['response']['blogs']);
				$('#search-result').append(blogs);
				$('#search-result').imagesLoaded(function() {
					$('.cont').removeClass('hidden');
					$('#search-result').masonry('appended', blogs);
				});
				page++;
			}
		});
	}
	
	$("#btn-search").click(function() {
		var keywords = $('#keywords').val();
		var not = $('#not-keywords').val();
		console.log(keywords);
		$.ajax({
			type: 'GET',
			url: '/api/searches/search.json',
			data: {'keywords': keywords, 'not': not},
			success: function(data, dataType) {
				console.log(data);
			}
		});
	});

	var diary = $('#search-result');
	diary.masonry({
    	itemSelector: '.cont',
     	isAnimated: true,
		isFitWidth: true,
		columnWidth: 1
	});
	loadBlogs();
	// setTimeout("loadBlogs();", 2000);
	
	// get tags from DB
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			console.log('success');
			//tagbox
			$('.tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>
<script id="searchTemplate" type="text/x-jquery-tmpl">
<div class="cont hidden" style="float:left">
	<div class="cont-pic">
		<a href="/blogs/view/${Blog.id}" class="link"></a>
		{{if UsedBlogImage.length != 0}}
			<img  src="${UsedBlogImage[0].url}" data-original="${UsedBlogImage[0].url}" class="cover" width="220px" height="auto">
		{{else}}
			<div style="width: 220px;height:220px">${Blog.title}</div>
			${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,99) +""}
		{{/if}}
		<div class="cont-info">
			<div class="cont-title">
				<p>
					${Blog.title.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}
				</p>
			</div>
			<div class="cont-detail">
			</div>
		</div>
	</div>
</div>
</script>
