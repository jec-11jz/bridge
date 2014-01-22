<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<div>
	<legend>All Production</legend>
	<table class="table">
		<th>作品ID</th>
		<th>作品名</th>
		<th>削除</th>
		<?php foreach($products as $product) : ?>
			<tr>
			<?php if(isset($product['Product']['id'])){ ?>
				<td><a href="/products/edit/<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['id']; ?></a></td>
				<td><?php echo $product['Product']['name']; ?></td>
				<td><?php echo $this->Form->postLink("", array('action' => 'delete',$product['Product']['id']),array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></td>
			<?php } ?>
			</tr>
		<?php endforeach; ?>
	</table>
	<legend>Link</legend>
	<a href="/templates/index" class="btn-a">テンプレート一覧</a>
</div>

