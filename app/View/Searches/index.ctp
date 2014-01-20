<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('automatic/style', null, array('inline' => false));
	
	// $this->Html->script('liffect', array('inline' => false));
	$this->Html->script('automatic/jquery.montage', array('inline' => false));
	echo $this->Html->script('masonry.pkgd');
	echo $this->Html->script('imagesloaded');
	echo $this->Html->script('jquery.lazyload');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
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
</div>


<script>
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
	$(function(){
		var diary = $('#search-result');
		diary.masonry({
	    	itemSelector: '.cont',
	     	isAnimated: true,
			isFitWidth: true,
			columnWidth: 1
		});
		loadBlogs();
		// setTimeout("loadBlogs();", 2000);
	});
</script>

<script id="searchTemplate" type="text/x-jquery-tmpl">
<div class="cont" style="float:left">
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
