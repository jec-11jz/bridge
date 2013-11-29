<?php
		echo $this->Html->css('diary');
		echo $this->Html->css('swipebox/style');
		
		echo $this->Html->script('swipebox/jquery.swipebox');
		echo $this->Html->script('swipebox/jquery-2.0.3.min');
?>

<script>
	jQuery(function($) {
	$(".swipebox").swipebox();
	});
</script>
<body>
	<div id="head-all"></div>
	<!-- Container -->
	<div id="container">
		<!-- Header --><!-- //Header -->
		
		<!-- Contents -->
		<div id="contents">
		<p>
			<a href="/blogs/add" class="btn-a">新規作成</a>
		</p>
		<table class="table table-hover">
	    <th>タイトル</th>
	    <th>操作</th>
	    <th>作成日時</th>
	    <th>画像</th>
	    <th>削除</th>
	    <th>ユーザID</th>
		<?php foreach($blogs as $blog) : ?>
			<tr>
			  	<td><a href=""><?php echo $blog['Blog']['title']; ?></a></td>
			  	<td>
			  		<a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn-a"> 編集</a> 		
			  	</td>
				<td><a><?php echo $blog['Blog']['created']; ?></a></td>
				<td width="200px" height="auto">
					<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
						<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
					<?php } else { ?>
						<div>画像なし</div>
						<?php
							$len = 100;
							print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
						?>
					<?php } ?>
				</td>
				<td>
					<a class="btn-a"><?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '本当に削除しますか？')); ?></a>
				</td>
				<td>
					<?php echo $users['User']['name']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		
		<a href="/home/index" class="swipebox" title="My Caption">
		<img src="../../img/1/1.jpg" alt="image">
		</a>
		<!-- //Contents -->

		<!-- footer --><!-- //footer -->

	</div>
	<!-- //Container -->
</body>