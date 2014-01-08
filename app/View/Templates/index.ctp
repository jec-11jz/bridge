<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
		
		
?>
<style>
	body {
		background: #FFFFFF;
	}
</style>
<legend>Link</legend>
<a href="/templates/add" class="btn-a">テンプレート作成</a>
<a href="/products/index" class="btn-a">作品一覧</a>
<legend>My Templates and My Attributes</legend>
<div id="template-index">
	<!-- テンプレート一覧 -->
	<h2>テンプレート一覧</h2>
	<table class="table">
		<th>テンプレート名</th>
		<th>テンプレートID</th>
		<th>削除</th>
		<?php foreach($templates as $template) : ?>
		<tr>
			<?php if(isset($template['Template']['id'])){ ?>
				<?php $fontColor = 0; ?>
				<td><a href="/templates/edit/<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></a></td>
				<td><?php echo $template['Template']['id']; ?></td>
				<td><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></td>
			<?php } ?>
		</tr>
		<?php endforeach; ?>
	</table>
	<!-- アトリビュート一覧 -->
	<h2>属性一覧</h2>
	<table class="table">
		<?php foreach($templates as $template) : ?>
			<?php if($template['Attribute'] != false) { ?>
				<th><?php echo h($template['Template']['name'] . '：' . $template['Template']['id']); ?></th>
				<?php foreach($template['Attribute'] as $attribute) : ?>
					<tr>
					<?php if(isset($attribute['name'])){ ?>
						<td><?php echo $attribute['name']; ?></td>
					<?php } ?>
					</tr>
				<?php endforeach; ?>
			<?php } ?>
		<?php endforeach; ?>
	</table>
</div>
</div>
