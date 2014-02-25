<?php
	echo $this->Html->css('toppage.css', null, array('inline' => false));
	echo $this->Html->css('slicebox/slicebox', null, array('inline' => false));
	
	echo $this->Html->script('slicebox/jquery.slicebox');
	
	$this->extend('/Common/index');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<div id="toppage">
	<h2>Welecome to Bridge</h2>
	<div class="div-search">
		<input name="keywords" id="keywords" class="form-control main-search" value="" placeholder='Search  here...'>
		<input type="submit" value="Search" class="btn-green button-search" id="btn-search">
	</div>
	<hr>
	<div class="toppage-body">
		<div id="top-button" class="top-area">
			<button id="new-product" class="top-button">new product</button>
			<button id="most-popular-product" class="top-button">most popular product</button>
			<button id="new-blog" class="top-button">new blog</button>
			<button id="most-popular-blog" class="top-button">most popular blog</button>
		</div>

		<div id="shadow" class="shadow"></div>
		<div id="nav-arrows" class="nav-arrows">
			<div class="arrows-left">
				<a href="#"><i class="fa fa-angle-left"></i> Previous</a>
			</div>
			<div class="arrows-right">
				<a>Next <i class="fa fa-angle-right"></i></a>
			</div>
		</div>
		<div id="top-image">
			<ul id="sb-slider" class="sb-slider"></ul>
		</div>
	</div> <!-- toppage-body -->

</div><!-- toppage -->
<script type="text/javascript">
	$(document).ready( function(){
		// create slicebox
		$.ajax({
			type: 'GET',
			url: '/api/home/get_toppage_contents.json',
			success: function(data){
				console.log(data['response']);
				// new-product
				var newProduct = $('#sb-new-product').tmpl(data['response']['newProduct']);
				$('#sb-slider').append(newProduct);
				// most-popular-product
				var mostPopularProudct = $('#sb-most-popular-product').tmpl(data['response']['mostPopularProduct']);
				$('#sb-slider').append(mostPopularProudct);
				// new-blog
				var newBlog = $('#sb-new-blog').tmpl(data['response']['newBlog']);
				$('#sb-slider').append(newBlog);
				// most-popular-blog
				var mostPopularBlog = $('#sb-most-popular-blog').tmpl(data['response']['mostPopularBlog']);
				$('#sb-slider').append(mostPopularBlog);
				// slicebox
				Page = (function() {
					$('#top-button').find('.new-product').addClass('current-category');
					var $navArrows = $('#nav-arrows').hide(),
						$shadow = $('#shadow').hide(),
						slicebox = $('#sb-slider').slicebox({
							onReady: function() {
								$navArrows.show();
								$shadow.show();
							},
							orientation: 'r',
							cuboidsRandom: true,
							disperseFactor: 30,
							autoplay: true,
						}),
						init = function() {
							initEvents();
						},
						initEvents = function() {
							// add navigation events
							$navArrows.children(':first').on('click', function() {
								slicebox.next();
								return false;
							});
							$navArrows.children(':last').on('click', function() {
								slicebox.previous();
								return false;
							});
						};
					return {
						init: init
					};
				})();
				Page.init();
			},
			error: function(xhr, xhrStatus){
				console.log('error');
			}
		});
	});
	
	// click related tags
	// fn search from tag
	$('#btn-search').click(function(){
		var keyword = $('#keywords').val();
		location.href = '/searches/index/?keywords=' + keyword;
	});
	// change image when push the top-button
	$(document).on('click', '.top-button', function(){
		var currentID = $('#top-image').find('.sb-current');
		var currentCategory = $('#top-button').find('.current-category');
		currentCategory.removeClass('current-category');
		$('#top-button').find('#' + $(this).attr('id')).addClass('current-category');
		currentID.removeClass('sb-current').hide();
		$('#top-image').find('#' + $(this).attr('id') + '-list').css( 'display', 'block' ).addClass( 'sb-current' );
	});
</script>
<script id="sb-new-product" type="text/x-jquery-tmpl">
	<a href="/products/view/${Product.id}" class="link"></a>
	<li id="new-product-list" class="image-list">
		{{if Product.image_url.length != 0 }}
			<img src="${Product.image_url}" alt="no Image"/>
		{{else}}
			<div class="div-noimage">
				<i class="fa fa-camera-retro"></i>
				<p>No image</p>
				
				<div class="div-noimage-outline">
					${Product.outline}
				</div>
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Product.name}</h3>
		</div>
	</li>
</script>
<script id="sb-most-popular-product" type="text/x-jquery-tmpl">
	<a href="/products/view/${Product.id}" class="link"></a>
	<li id="most-popular-product-list" class="image-list">
		{{if Product.image_url.length != 0 }}
			<img src="${Product.image_url}" alt="image1"/>
		{{else}}
			<div class="div-noimage">
				<i class="fa fa-camera-retro"></i>
				<p>No image</p>

				<div class="div-noimage-outline">
					${Product.outline}
				</div>
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Product.name}</h3>
		</div>
	</li>
</script>
<script id="sb-new-blog" type="text/x-jquery-tmpl">
	<a href="/blogs/view/${Blog.id}" class="link"></a>
	<li id="new-blog-list" class="image-list">
		{{if UsedBlogImage.length != 0}}
			<img src="${UsedBlogImage[0].url}" class="diary-pic">
		{{else}}
			<div class="div-noimage">
				<i class="fa fa-camera-retro"></i>
				<p>No image</p>

				<div class="div-noimage-outline">
					${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,300) +"..."}
				</div>
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Blog.title}</h3>
		</div>
	</li>
</script>
<script id="sb-most-popular-blog" type="text/x-jquery-tmpl">
	<a href="/blogs/view/${Blog.id}" class="link"></a>
	<li id="most-popular-blog-list" class="image-list">
		{{if UsedBlogImage.length != 0}}
			<img src="${UsedBlogImage[0].url}" class="diary-pic">
		{{else}}
			<div class="div-noimage">
				<i class="fa fa-camera-retro"></i>
				<p>No image</p>

				<div class="div-noimage-outline">
					${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,300) +"..."}
				</div>
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Blog.title}</h3>
		</div>
	</li>
</script>

