<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<div>
	<legend>Link</legend>
	<a href="/templates/index" class="btn-a">テンプレート一覧</a>
	<legend>All Production</legend>
	<table class="table">
		<th>作品ID</th>
		<th>作品名</th>
		<?php foreach($products as $product) : ?>
			<tr>
			<?php if(isset($product['Product']['id'])){ ?>
				<td><a href="/products/edit/<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['id']; ?></a></td>
				<td><?php echo $product['Product']['name']; ?></td>
			<?php } ?>
			</tr>
		<?php endforeach; ?>
	</table>
	<form method="get" action="/products/add">
		<legend>テンプレート選択</legend>
		<select name="data" class="template-name" id="selected-template">
			<option value="" disabled selected>--選択してください--</option>
			<?php foreach($templates as $template) : ?>
				<?php if(isset($template['Template']['id'])){ ?>
					<option value="<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></option>
				<?php } ?>
			<?php endforeach; ?>
			<option value="other">テンプレート作成</option>
		</select>
		<hr size="2">
		<input type="submit" class="btn-a" value="作品作成" />
	</form>
	
</div>
<script>
	$(function(){
		//テンプレートが選択されたら編集画面に飛ばす
		$("#selected-template").change(function() {
			var temp_id = $('#selected-template').val();
			console.log(temp_id);
			if(temp_id == 'other'){
				location.href="/templates/add";
				return;
			}// End if()
		});// End change()
	})
</script>

