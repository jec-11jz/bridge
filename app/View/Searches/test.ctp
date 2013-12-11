<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('automatic/style', null, array('inline' => false));
	$this->Html->css('automatic/demo', null, array('inline' => false));
	
	$this->Html->script('automatic/jquery.montage', array('inline' => false));
	
?>
<script>
    $(document).ready(function(){  
        //マスオーバー時に右にスライド  
        $('.boxgrid.slideright').hover(function(){  
            $(".cover", this).stop().animate({left:'450px'},{queue:false,duration:200});  
        }, function() {  
            $(".cover", this).stop().animate({left:'0px'},{queue:false,duration:200});  
        });   
        //マスオーバー時に右下にスライド  
        $('.boxgrid.thecombo').hover(function(){  
            $(".cover", this).stop().animate({top:'300px', left:'450px'},{queue:false,duration:300});  
        }, function() {  
            $(".cover", this).stop().animate({top:'0px', left:'0px'},{queue:false,duration:300});  
        });  
        //マスオーバー時に上にスライド  
        $('.boxgrid.slidedown').hover(function(){  
            $(".cover", this).stop().animate({top:'-300px'},{queue:false,duration:300});  
        }, function() {  
            $(".cover", this).stop().animate({top:'0px'},{queue:false,duration:300});  
        });  
    });  
    
    
    	$(function() {
				/* 
				 * just for this demo:
				 */
				$('#showcode').toggle(
					function() {
						$(this).addClass('up').removeClass('down').next().slideDown();
					},
					function() {
						$(this).addClass('down').removeClass('up').next().slideUp();
					}
				);
				$('#panel').toggle(
					function() {
						$(this).addClass('show').removeClass('hide');
						$('#overlay').stop().animate( { left : - $('#overlay').width() + 20 + 'px' }, 300 );
					},
					function() {
						$(this).addClass('hide').removeClass('show');
						$('#overlay').stop().animate( { left : '0px' }, 300 );
					}
				);
				
				var $container 	= $('#am-container'),
					$imgs		= $container.find('img').hide(),
					totalImgs	= $imgs.length,
					cnt			= 0;
				
				$imgs.each(function(i) {
					var $img	= $(this);
					$('<img/>').load(function() {
						++cnt;
						if( cnt === totalImgs ) {
							$imgs.show();
							$container.montage({
								minw : 100,
								alternateHeight : true,
								alternateHeightRange : {
									min	: 50,
									max	: 350
								},
								margin : 8,
								fillLastRow : true
							});
							
							/* 
							 * just for this demo:
							 */
							$('#overlay').fadeIn(500);
							var imgarr	= new Array();
							for( var i = 1; i <= 73; ++i ) {
								imgarr.push( i );
							}
							$('#loadmore').show().bind('click', function() {
								var len = imgarr.length;
								for( var i = 0, newimgs = ''; i < 15; ++i ) {
									var pos = Math.floor( Math.random() * len ),
										src	= imgarr[pos];
									newimgs	+= '<a href="#"><img src="images/' + src + '.jpg"/></a>';
								}
								
								var $newimages = $( newimgs );
								$newimages.imagesLoaded( function(){
									$container.append( $newimages ).montage( 'add', $newimages );
								});
							});
						}
					}).attr('src',$img.attr('src'));
				});	
				
			});

</script>  

			


<div id="search">
	<hr>
	 <?php
		 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
		 echo $this->Form->input('Words',array('label' => false, 'name' => 'data[Search][condition]','class' => 'form-control','placeholder' => 'Search here...'));
		 echo $this->Form->submit('検索',array('class' => 'btn-a btn-search'));
		 echo $this->Form->end();
	 ?>
	 
	<hr>
	<div id="result">
		
	
		<!-- 
	<div class="cont" style="float:left">
		
		
		<div class="boxgrid slideright">
				<a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"> </a>
			    
				
		    <div class="cover boxcaption">
		        <a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>" style="display: block">
		        	<?php 
						if(mb_strlen($blog['Blog']['title']) <= 7){
							echo $blog['Blog']['title']; 
						} else {
							$len = 22;
							print(mb_strimwidth($blog['Blog']['title'], 0, $len, "...", "UTF-8") . "<br />");
						}
					?>
	        	</a>
		    </div>
		</div>
	</div> -->	
	</div>
</div> <!-- END search -->
	
	 
	 
	 <hr>
	 
	 
	 <div id="overlay" class="content">
				<div class="inner">
					<h1>Automatic Image Montage <span>with jQuery</span></h1>
					<h2>Minimum width of images with alternating heights of rows and large margin, last image will fill the last row. Click "load more" (end of page) in order to see how more images can be added.</h2>
					<div class="snippet">
						<span id="showcode" class="down">View the options for this example</span>
						<!-- <pre>
minw : 100,
alternateHeight : true,
alternateHeightRange : {
	min	: 50,
	max	: 350
},
margin : 8,
fillLastRow : true
						</pre> -->
					</div>
					<div class="clr"></div>
					<div id="panel" class="panel hide"></div>
				</div>
			</div>
			<div class="am-container" id="am-container">
				
				<?php foreach($blogs as $blog) : ?>
					<!-- <a><img  src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="auto" height="auto"></a> -->
				<?php endforeach; ?>
				<a href="#"><img src="../../img/auto/1.jpg"></img></a>
				<a href="#"><img src="../../img/auto/2.jpg"></img></a>
				<a href="#"><img src="../../img/auto/3.jpg"></img></a>
				<a href="#"><img src="../../img/auto/4.jpg"></img></a>
				<a href="#"><img src="../../img/auto/5.jpg"></img></a>
				<a href="#"><img src="../../img/auto/6.jpg"></img></a>
				<a href="#"><img src="../../img/auto/7.jpg"></img></a>
				<a href="#"><img src="../../img/auto/8.jpg"></img></a>
				<a href="#"><img src="../../img/auto/9.jpg"></img></a>
				<a href="#"><img src="../../img/auto/10.jpg"></img></a>
				<a href="#"><img src="../../img/auto/11.jpg"></img></a>
				<a href="#"><img src="../../img/auto/12.jpg"></img></a>
				<a href="#"><img src="../../img/auto/13.jpg"></img></a>
				<a href="#"><img src="../../img/auto/14.jpg"></img></a>
				<a href="#"><img src="../../img/auto/15.jpg"></img></a>
				<a href="#"><img src="../../img/auto/16.jpg"></img></a>
				<a href="#"><img src="../../img/auto/17.jpg"></img></a>
				<a href="#"><img src="../../img/auto/18.jpg"></img></a>
				<a href="#"><img src="../../img/auto/19.jpg"></img></a>
				<a href="#"><img src="../../img/auto/20.jpg"></img></a>
				<a href="#"><img src="../../img/auto/21.jpg"></img></a>
				<a href="#"><img src="../../img/auto/22.jpg"></img></a>
				<a href="#"><img src="../../img/auto/23.jpg"></img></a>
				<a href="#"><img src="../../img/auto/24.jpg"></img></a>
				<a href="#"><img src="../../img/auto/25.jpg"></img></a>
				<a href="#"><img src="../../img/auto/26.jpg"></img></a>
				<a href="#"><img src="../../img/auto/27.jpg"></img></a>
				<a href="#"><img src="../../img/auto/28.jpg"></img></a>
				<a href="#"><img src="../../img/auto/29.jpg"></img></a>
				<a href="#"><img src="../../img/auto/30.jpg"></img></a>
				<a href="#"><img src="../../img/auto/31.jpg"></img></a>
				<a href="#"><img src="../../img/auto/32.jpg"></img></a>
				<a href="#"><img src="../../img/auto/33.jpg"></img></a>
				<a href="#"><img src="../../img/auto/34.jpg"></img></a>
				<a href="#"><img src="../../img/auto/35.jpg"></img></a>
				<a href="#"><img src="../../img/auto/36.jpg"></img></a>
				<a href="#"><img src="../../img/auto/37.jpg"></img></a>
				<a href="#"><img src="../../img/auto/38.jpg"></img></a>
				<a href="#"><img src="../../img/auto/39.jpg"></img></a>
				<a href="#"><img src="../../img/auto/40.jpg"></img></a>
				<a href="#"><img src="../../img/auto/41.jpg"></img></a>
				<a href="#"><img src="../../img/auto/42.jpg"></img></a>
				<a href="#"><img src="../../img/auto/43.jpg"></img></a>
				<a href="#"><img src="../../img/auto/44.jpg"></img></a>
				<a href="#"><img src="../../img/auto/45.jpg"></img></a>
				<a href="#"><img src="../../img/auto/46.jpg"></img></a>
				<a href="#"><img src="../../img/auto/47.jpg"></img></a>
				<a href="#"><img src="../../img/auto/48.jpg"></img></a>
				<a href="#"><img src="../../img/auto/49.jpg"></img></a>
				<a href="#"><img src="../../img/auto/50.jpg"></img></a>
				<a href="#"><img src="../../img/auto/51.jpg"></img></a>
				<a href="#"><img src="../../img/auto/52.jpg"></img></a>
				<a href="#"><img src="../../img/auto/53.jpg"></img></a>
				<a href="#"><img src="../../img/auto/54.jpg"></img></a>
				<a href="#"><img src="../../img/auto/55.jpg"></img></a>
				<a href="#"><img src="../../img/auto/56.jpg"></img></a>
				<a href="#"><img src="../../img/auto/57.jpg"></img></a>
				<a href="#"><img src="../../img/auto/58.jpg"></img></a>
				<a href="#"><img src="../../img/auto/59.jpg"></img></a>
				<a href="#"><img src="../../img/auto/60.jpg"></img></a>
				<a href="#"><img src="../../img/auto/61.jpg"></img></a>
				<a href="#"><img src="../../img/auto/62.jpg"></img></a>
				<a href="#"><img src="../../img/auto/63.jpg"></img></a>
				<a href="#"><img src="../../img/auto/64.jpg"></img></a>
				<a href="#"><img src="../../img/auto/65.jpg"></img></a>
				<a href="#"><img src="../../img/auto/66.jpg"></img></a>
				<a href="#"><img src="../../img/auto/67.jpg"></img></a>
				<a href="#"><img src="../../img/auto/68.jpg"></img></a>
				<a href="#"><img src="../../img/auto/69.jpg"></img></a>
				<a href="#"><img src="../../img/auto/70.jpg"></img></a>
				<a href="#"><img src="../../img/auto/71.jpg"></img></a>
				<a href="#"><img src="../../img/auto/72.jpg"></img></a>
				<a href="#"><img src="../../img/auto/73.jpg"></img></a>
			</div>
			<div id="loadmore" class="loadmore" style="width:100%;">load more...</div>
		</div>

