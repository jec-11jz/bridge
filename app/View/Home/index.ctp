<?php
	echo $this->Html->css('toppage.css');
	
	
	echo $this->Html->script('slidr/slidr-ck');
?>
	
<body>
	<div id#head-all></div>
	<div id="container">
		<div class="contents">
		<div id="toppage">
			<div class='toppage_link'>
				<div>
				<script>
					$(function(){
						var s = slidr.create('slidr-img',{
							breadcrumbs: true,
							transition: 'cube',
							timing: { 'cube': '0.5s ease-in' },
							fade: true,
							overflow: true
						})
						s.add('h',['one','two','three','one']);
						s.start();
					});
				</script>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
	
	 
	<div id="slidr-img" style="display: inline-block">
	  <img data-slidr="one" src="../../img/Bridge_photoes/iron-man/iron-man1.jpg">
	  <img data-slidr="two" src="../../img/Bridge_photoes/iron-man/iron-man2.jpg">
	  <img data-slidr="three" src="../../img/Bridge_photoes/iron-man/iron-man3.jpg">
	</div>
	 
