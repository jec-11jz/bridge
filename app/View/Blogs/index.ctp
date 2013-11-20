<?php
		echo $this->Html->css('btn_custom');
		echo $this->Html->css('diary');
		
?>
<body>
	<!-- Container -->
	<div id="container">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div id="contents">
		<p>
			<a href="/blogs/add" class="btn btn-custom">新規作成</a>
		</p>
		<table class="table table-hover">
	    <th>タイトル</th>
	    <th>操作</th>
	    <th>作成日時</th>
	    <th>削除</th>
		<?php		
			foreach($blogs as $blog) :
		  // レコードデータから記事のidを取得
		  // Postはモデルクラス名、idはカラム名 ?>
		<tr>
		  	<td><a href=""><?php echo $blog['Blog']['title']; ?></a></td>
		  	<td>
		  		<?php echo $this->Html->link("編集",array('controller'=>'blogs','action' => 'edit',$blog['Blog']['id'])); ?> 
		  	</td>
			<td><a><?php echo $blog['Blog']['created'] ?></a></td>
			<td>
				<?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '本当に削除しますか？')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->

	</div>
	<!-- //Container -->
</body>