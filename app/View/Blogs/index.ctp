<?php
	echo $this->Html->css('user_add');
?>
<body>
	<!-- Container -->
	<div id="container">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div id="contents">
		<p>
			<a href="/blogs/add" class="btn-custom user-add">新規作成</a>
		</p>
		<table>
	    <th>タイトル</th>
	    <th>操作</th>
	    <th>作成日時</th>
		<?php		
			foreach($blogs as $blog) :
		  // レコードデータから記事のidを取得
		  // Postはモデルクラス名、idはカラム名 ?>
		<tr>
		  	<td><a href=""><?php echo $blog['Blog']['title']; ?></a></td>
		  	<td>
		  		<?php echo $this->Html->link("編集",array('controller'=>'blogs','action' => 'edit',$blog['Blog']['id'])); ?> 
		        <?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '本当に削除しますか？')); ?>
		  	</td>
			<td><a><?php echo $blog['Blog']['created'] ?></a></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->

	</div>
	<!-- //Container -->
</body>