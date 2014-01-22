<?php
	echo $this->Html->css('toppage.css', null, array('inline' => false));
	echo $this->Html->css('slicebox/slicebox', null, array('inline' => false));
	
	echo $this->Html->script('slicebox/jquery.slicebox');
	
	$this->extend('/Common/index');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>
<style>
	#toppage {
		display: block;
		clear: both;
	}
	.clearFix {
		clear: both;
		display: block;
	}
	.top-area {
		text-align:center;
		margin:8.000em;
	}
	.top-button {
		display:inline-block;
		border:4px solid #d8d8d8;
		color:#EEE;
		text-decoration:none;
		padding:10px;
		transition-duration: 0.2s;
		border-radius: 5px;	
	}
	#top-image {
		width: 80%;
	}
</style>

<div id="toppage">
	<div id="top-button" class="top-area">
		<h2>Welecome to Bridge</h2>
		<button class="top-button new-product">new product</button>
		<button class="top-button most-popular-product">most popular product</button>
		<button class="top-button new-diary">new diary</button>
		<button class="top-button most-popular-diary">most popular diary</button>
	</div>
	<div id="error"></div>
	<div id="top-image" class="top-area">
		<ul id="sb-slider" class="sb-slider"></ul>
	</div>
		
		

	<!-- <ul id="sb-slider" class="sb-slider">
		<li>
			<a href="http://www.flickr.com/photos/strupler/2969141180" target="_blank">
				<img src="/img/slicebox/1.jpg" alt="image1"/>
			</a>
			<div class="sb-description">
				<h3>Creative Lifesaver</h3>
			</div>
		</li>
		<li>
			<a href="http://www.flickr.com/photos/strupler/2968268187" target="_blank">
				<img src="/img/slicebox/2.jpg" alt="image2"/>
			</a>
			<div class="sb-description">
				<h3>Honest Entertainer</h3>
			</div>
		</li>
		<li>
			<a href="http://www.flickr.com/photos/strupler/2968114825" target="_blank">
				<img src="/img/slicebox/3.jpg" alt="image1"/>
			</a>
			<div class="sb-description">
				<h3>Brave Astronaut</h3>
			</div>
		</li>
		<li>
			<a href="http://www.flickr.com/photos/strupler/2968126177" target="_blank">	
				<img src="/img/slicebox/6.jpg" alt="image2"/>
			</a>
			<div class="sb-description">
				<h3>Groundbreaking Artist</h3>
			</div>
		</li>
	</ul> -->
	
	<div id="shadow" class="shadow"></div>
	<div id="nav-arrows" class="nav-arrows">
		<a href="#">Previous</a>
		<a href="#">Next</a>
	</div>
</div><!-- toppage -->
<script type="text/javascript">
	$(document).ready( function(){


		//create slicebox
		$.ajax({
			type: 'GET',
			url: '/api/home/get_toppage_contents.json',
			success: function(data){
				contents = $('#toppage-contents').tmpl(data['response']['newProduct']);
				$('#sb-slider').append(contents);
				//slicebox
				Page = (function() {
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
</script>
<script id="toppage-contents" type="text/x-jquery-tmpl">
	<li class="new-product">
		<a href="http://www.flickr.com/photos/strupler/2969141180" target="_blank">
			<img src="${Product.image_url}" alt="image1"/>
		</a>
		<div class="sb-description">
			<h3>${Product.name}</h3>
		</div>
	</li>
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>

