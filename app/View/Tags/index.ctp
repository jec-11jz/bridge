<p><h1>タグ一覧</h1></p>
<table class="table">
	<th>タグ名</th>
	<th>タグID</th>
	<th>ユーザID</th>
	<th>作成日</th>
	<th>操作</th>
	<?php echo $this->Session->flash('tag'); ?>
	<h1><?php echo $this->Html->link('add',array('controller' => 'tags', 'action'=>'add')); ?></h1>
	<h1><?php echo $this->Html->link('edit',array('controller' => 'tags', 'action'=>'edit')); ?></h1>
    <?php foreach($tags as $tag): ?>
       <!-- 配列のデータを取り出してechoで出力する、h()はエスケープ -->
        	<tr>
	        	<td><?php echo h($tag['Tag']['name']); ?></td>
	        	<td><?php echo h($tag['Tag']['id']); ?></td>
	        	<td><?php echo h($tag['Tag']['user_id']); ?></td>
	        	<td><?php echo h($tag['Tag']['created']); ?></td>
	        	<td><?php echo $this->Form->postLink("削除", array('action' => 'delete',$tag['Tag']['id']),array('confirm' => '本当に削除しますか？')); ?></td>
	        </tr>
    <?php endforeach; ?>
</table>