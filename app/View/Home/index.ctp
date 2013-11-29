<?php
	echo $this->Html->css('toppage.css');
	echo $this->Html->script('slidr/slidr-ck');
?>
<div id="head-all"></div>
	<div id="toppage">
		<script>
			$(function(){
				var s = slidr.create('slidr-img',{
					breadcrumbs: true,
					transition: 'cube',
					timing: { 'cube': '0.5s ease-in' },
					fade: true,
					overflow: true
				})
				s.add('h',['one','two','three','four','five','one']);
				s.start();
			});
		</script>
	</div> <!-- end toppage -->
<div id="foot-all"></div>

<!-- トップページの画像 -->
<div id="slidr-img" style="display: inline-block">
	<img data-slidr="one" src="../../img/Bridge_photoes/iron-man/iron-man1.jpg">
	<img data-slidr="two" src="../../img/Bridge_photoes/iron-man/iron-man2.jpg">
	<img data-slidr="three" src="../../img/Bridge_photoes/iron-man/iron-man3.jpg">
	<img data-slidr="four" src="../../img/Bridge_photoes/iron-man/time.jpg">
	<img data-slidr="five" src="../../img/Bridge_photoes/iron-man/iron-man4.jpg">
</div>
	 
