<?php
	echo $this->Html->css('toppage.css', null, array('inline' => false));
	echo $this->Html->css('slicebox/slicebox', null, array('inline' => false));
	
	echo $this->Html->script('slicebox/jquery.slicebox');
	
	$this->extend('/Common/index');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<div id="toppage">
	<div id="top-button" class="top-area">
		<h2>Welecome to Bridge</h2>
		<button id="new-product" class="top-button">new product</button>
		<button id="most-popular-product" class="top-button">most popular product</button>
		<button id="new-blog" class="top-button">new blog</button>
		<button id="most-popular-blog" class="top-button">most popular blog</button>
	</div>
	<div id="shadow" class="shadow"></div>
	<div id="nav-arrows" class="nav-arrows">
		<a href="#">Previous</a>
		<a href="#">Next</a>
	</div>
	<div id="error"></div>
	<div id="top-image">
		<ul id="sb-slider" class="sb-slider"></ul>
	</div>
</div><!-- toppage -->
<script type="text/javascript">
	$(document).ready( function(){
		// create slicebox
		$.ajax({
			type: 'GET',
			url: '/api/home/get_toppage_contents.json',
			success: function(data){
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
				//slicebox
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
							autoplay: true
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
				error = $('#error-message').tmpl(xhr['responseJSON']['error']);
				$('#error').append(error);
				$('body,html').animate({
			        scrollTop: 0
			    }, 100);
			    return false;
			}
		});
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
	<li id="new-product-list" class="image-list">
		<a href="" target="_blank">
			<img src="${Product.image_url}" alt="image1"/>
		</a>
		<div class="sb-description">
			<h3>${Product.name}</h3>
		</div>
	</li>
</script>
<script id="sb-most-popular-product" type="text/x-jquery-tmpl">
	<li id="most-popular-product-list" class="image-list">
		<a href="" target="_blank">
			<img src="${Product.image_url}" alt="image1"/>
		</a>
		<div class="sb-description">
			<h3>${Product.name}</h3>
		</div>
	</li>
</script>
<script id="sb-new-blog" type="text/x-jquery-tmpl">
	<li id="new-blog-list" class="image-list">
		{{if UsedBlogImage.length != 0}}
			<a style="background-color: white;width:100%;height100%;">
				<img src="${UsedBlogImage[0].url}" class="diary-pic">
			</a>
		{{else}}
			<div class="text-index" style="width: 220px; height:200px">
				[no images]<br/>
				${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,99) +""}
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Blog.title}</h3>
		</div>
	</li>
</script>
<script id="sb-most-popular-blog" type="text/x-jquery-tmpl">
	<li id="most-popular-blog-list" class="image-list">
		{{if UsedBlogImage.length != 0}}
			<a style="background-color: white;width:100%;height100%;">
				<img src="${UsedBlogImage[0].url}" class="diary-pic">
			</a>
		{{else}}
			<div class="text-index" style="width: 220px; height:200px">
				[no images]<br/>
				${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,99) +""}
			</div>
		{{/if}}
		<div class="sb-description">
			<h3>${Blog.title}</h3>
		</div>
	</li>
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>

