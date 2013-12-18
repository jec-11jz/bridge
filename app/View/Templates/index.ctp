<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
		
		
?>

<script>
</script>
<a href="/templates/add" class="btn-a">テンプレート作成</a>



<div id="template-index">
	<!-- テンプレート一覧 -->
	<h2>テンプレート一覧</h2>
	<table class="table">
		<th>テンプレート名</th>
		<th>テンプレートID</th>
		<?php foreach($templates as $template) : ?>
		<tr>
			<?php if(isset($template['Template']['id'])){ ?>
				<?php $fontColor = 0; ?>
				<td><?php echo $template['Template']['name']; ?></td>
				<td><?php echo $template['Template']['id']; ?></td>
			<?php } ?>
		</tr>
		<?php endforeach; ?>
	</table>
	<!-- アトリビュート一覧 -->
	<h2>属性一覧</h2>
	<table class="table">
		<th>属性名</th>
		<th>テンプレートID</th>
		<?php foreach($templates as $template) : ?>
			<?php foreach($template['Attribute'] as $attribute) : ?>
			<tr>
			<?php if(isset($attribute['name'])){ ?>
				<?php $fontColor = 0; ?>
				<td><?php echo $attribute['name']; ?></td>
				<td><?php echo $attribute['template_id']; ?></td>
			<?php } ?>
			</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</table>
</div>
</div>