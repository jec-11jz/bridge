<?php
	echo $this->Html->css('toppage.css');
?>
	
<body onload="javascript: change();">
	<!-- Container -->
	<div id="toppage">
		<!-- Header -->
		
		<!-- //Header -->

		<!-- Contents -->
		    <!-- ここのコンテンツ -->
		<div id='link'>
			<ul style="list-style:none">
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon02.jpg',
							array('url'=>array('controller'=>'users','action'=>'index'), 'class' => 'logo'));?><br/>作品検索</li>
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon07.jpeg',
							array('url'=>array('controller'=>'users','action'=>'add'), 'class' => 'logo'));?><br/>登録</li>
				<li style="float: left" class="logo"><?php echo $this->Html->image('../img/icon06.jpg',
							array('url'=>array('controller'=>'users','action'=>'login'), 'class' => 'logo'));?><br/>日記作成</li>
			</ul>
		</div>
		<a class="modalLink"><?php echo $this->Html->link('ログイン',array('controller' => 'users','action'=>'login')); ?></a>
		<div class="modal">
			<div class="overlay"></div>
			<a href="#" class="closeBtn">Close Me</a>
		</div>
		<!-- //Contents -->
		<!-- footer -->
		<footer id="footer">
			<p class="copyright">
				<small>copyright &copy; Bridge</small>
			</p>
		</footer>
		<!-- //footer -->

	</div>
	<!-- //Container -->
</body>