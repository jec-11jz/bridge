<?php
	echo $this->Html->css('toppage.css', null, array('inline' => false));
	echo $this->Html->css('slicebox/slicebox', null, array('inline' => false));
	
	echo $this->Html->script('slicebox/jquery.slicebox');
	
	$this->extend('/Common/index');
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
</style>

<div id="toppage">
	<div class="top-area">
		<h2>Welecome to Bridge</h2>
		<button class="top-button new-product">new product</button>
		<button class="top-button most-popular-product">most popular product</button>
		<button class="top-button new-diary">new diary</button>
		<button class="top-button most-popular-diary">most popular diary</button>
		
		

	<ul id="sb-slider" class="sb-slider">
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
			<a href="http://www.flickr.com/photos/strupler/2968122059" target="_blank">
				<img src="/img/slicebox/4.jpg" alt="image1"/>
			</a>
			<div class="sb-description">
				<h3>Affectionate Decision Maker</h3>
			</div>
		</li>
		<li>
			<a href="http://www.flickr.com/photos/strupler/2969119944" target="_blank">
				<img src="/img/slicebox/5.jpg" alt="image1"/>
			</a>
			<div class="sb-description">
				<h3>Faithful Investor</h3>
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
		<li>
			<a href="http://www.flickr.com/photos/strupler/2968945158" target="_blank">
				<img src="/img/slicebox/7.jpg" alt="image1"/>
			</a>
			<div class="sb-description">
				<h3>Selfless Philantropist</h3>
			</div>
		</li>
	</ul>
	
	<div id="shadow" class="shadow"></div>
	<div id="nav-arrows" class="nav-arrows">
		<a href="#">Previous</a>
		<a href="#">Next</a>
	</div>
</div><!-- toppage -->
<script type="text/javascript">
	$(document).ready( function(){
		//create slicebox
		
		//slicebox
		var Page = (function() {
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
	});
</script>

