<?php
	echo $this->Html->css('stapel/custom.css');
	echo $this->Html->css('stapel/demo.css');
	echo $this->Html->css('stapel/stapel.css');

	echo $this->Html->script('stapel/jquery.stapel');
	echo $this->Html->script('stapel/modernizr.custom.63321');
?>

<script type="text/javascript">
	$(function() {

				var $grid = $( '#tp-grid' ),
					$name = $( '#name' ),
					$close = $( '#close' ),
					$loader = $( '<div class="loader"><i></i><i></i><i></i><i></i><i></i><i></i><span>Loading...</span></div>' ).insertBefore( $grid ),
					stapel = $grid.stapel( {
						randomAngle : true,
						delay : 50,
						gutter : 70,
						pileAngles : 5,
						onLoad : function() {
							$loader.remove();
						},
						onBeforeOpen : function( pileName ) {
							$name.html( pileName );
						},
						onAfterOpen : function( pileName ) {
							$close.show();
						}
					} );

				$close.on( 'click', function() {
					$close.hide();
					$name.empty();
					stapel.closePile();
				} );

			} );
</script>
<body>
	<div id="head-all"></div>
	<div id="container">
		<div class="contents">
			
			<section class="main">
				<div class="wrapper">
					<div class="topbar">
						<span id="close" class="back">&larr;</span>
						<h2>Dribbble's Talent</h2><h3 id="name"></h3>
					</div>
					
					<ul id="tp-grid" class="tp-grid">

						<!-- Bryan Moats -->
						<li data-pile="Bryan Moats">
							<a href="http://drbl.in/cmVe">
								<span class="tp-info"><span>Flu &amp; You</span></span>
								<img src="../../img/1/1.jpg" />
							</a>
						</li>
						<li data-pile="Bryan Moats">
							<a href="http://drbl.in/cmhM">
								<span class="tp-info"><span>Test Your Flu IQ</span></span>
								<img src="../../img/1/2.jpg" />
							</a>
						</li>
						<li data-pile="Bryan Moats">
							<a href="http://drbl.in/eKdt">
								<span class="tp-info"><span>Unexpected Fatherly Faces and Feelings</span></span>
								<img src="../../img/1/3.jpg" />
							</a>
						</li>

						<!-- Mike Dornseif -->
						<li data-pile="Mike Dornseif">
							<a href="http://drbl.in/eiUm">
								<span class="tp-info"><span>On to Easter</span></span>
								<img src="../../img/2/1.jpg" />
							</a>
						</li>
						<li data-pile="Mike Dornseif">
							<a href="http://drbl.in/ekMY">
								<span class="tp-info"><span>Love Birds</span></span>
								<img src="../../img/2/2.jpg" />
							</a>
						</li>
						<li data-pile="Mike Dornseif">
							<a href="http://drbl.in/esQV">
								<span class="tp-info"><span>Here Fishy fishy</span></span>
								<img src="../../img/2/3.jpg" />
							</a>
						</li>

						<!-- Griffin Moore -->
						<li data-pile="Griffin Moore">
							<a href="http://drbl.in/fzUB">
								<span class="tp-info"><span>Briefcase</span></span>
								<img src="../../img/3/1.jpg" />
							</a>
						</li>
						<li data-pile="Griffin Moore">
							<a href="http://drbl.in/fQEv">
								<span class="tp-info"><span>Clipboard</span></span>
								<img src="../../img/3/2.jpg" />
							</a>
						</li>
						<li data-pile="Griffin Moore">
							<a href="http://drbl.in/fREU">
								<span class="tp-info"><span>Sweet pack</span></span>
								<img src="../../img/3/3.jpg" />
							</a>
						</li>

						<!-- Andrea Austoni -->
						<li data-pile="Andrea Austoni">
							<a href="http://drbl.in/cyWa">
								<span class="tp-info"><span>Growth in 2012 (Holiday Card)</span></span>
								<img src="../../img/4/1.jpg" />
							</a>
						</li>
						<li data-pile="Andrea Austoni">
							<a href="http://drbl.in/cRkb">
								<span class="tp-info"><span>Grady Wilson</span></span>
								<img src="../../img/4/2.jpg" />
							</a>
						</li>
						<li data-pile="Andrea Austoni">
							<a href="http://drbl.in/cSKM">
								<span class="tp-info"><span>More Cowbell</span></span>
								<img src="../../img/4/3.jpg" />
							</a>
						</li>
					</ul>
				</div>
			</section>
			
		</div>
	</div>
	<div id="foot-all"></div>
</body>
	
	 
