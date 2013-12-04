<?php
		echo $this->Html->css('diary');
		$this->extend('/Common/index');
?>
<table class="table table-hover">
	<th>タイトル</th>
	<th>操作</th>
	<th>作成日時</th>
	<th>画像</th>
	<th>削除</th>
	<th>ユーザID</th>
	<?php foreach($blogs as $blog) : ?>
		<tr>
		  	<td><a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"><?php echo $blog['Blog']['title']; ?></a></td>
		  	<td><a href="/blogs/edit/<?php echo $blog['Blog']['id'] ?>" class="btn-a"> 編集</a></td>
			<td><a><?php echo $blog['Blog']['created']; ?></a></td>
			<!-- start show image -->
			<td width="200px" height="auto">
				<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<!-- 画像が使用されている場合 -->
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<!-- 画像が使用されていない場合 -->
					<div>画像なし</div>
					<!-- 本文を１００文字表示する -->
					<?php
						$len = 100;
						print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
				<?php } ?>
			</td>
			<!-- end show image -->
			<td><?php echo $this->Form->postLink("削除", array('action' => 'delete',$blog['Blog']['id']),array('confirm' => '本当に削除しますか？')); ?></td>
			<td><?php echo $users['User']['name']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>
<a href="/blogs/add" class="btn-a">新規作成</a>