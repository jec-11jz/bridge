
<body>
	<!-- Container -->
	<div id="container">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div id="contents">
		<?php 
			echo $this->Html->link('投稿一覧へ戻る',
			    array('action' => 'index'));
		?>
		<hr />
		<h1><?php echo h($post['Post']['title']); ?></h1>

		<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>
		
		<p><?php echo h($post['Post']['body']); ?></p>
		</div>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->

	</div>
	<!-- //Container -->
</body>