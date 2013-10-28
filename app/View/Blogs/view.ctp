
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
		<h3><?php echo $this->Html->link($blog['Blog']['title'], array('controller' => 'blogs', 'action' => 'edit')); ?></h3>
		<p>
			<small>投稿日: <?php echo $blog['Blog']['created']; ?></small>
		</p>
		<hr />
		<p><?php echo h($blog['Blog']['content']); ?></p>
		</div>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->

	</div>
	<!-- //Container -->
</body>