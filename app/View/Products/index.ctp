<?php
	echo $this->Html->css('tag/tags_custom');
	echo $this->Html->css('products');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>

<script>
	$(function(){
		//テンプレートが選択されたら編集画面に飛ばす
		$("#selected-template").change(function() {
			var temp_id = $('#selected-template').val();
			console.log(temp_id);
			if(temp_id == 'other'){
				location.href="/templates/add";
				return;
			} else if(temp_id != ''){
				$('#add-product').removeAttr("disabled");
			}// End if()
		});// End change()
	})
</script>



<div id="products" class="form first-content-form">
	<div class="form-headder">
		<h1>All Production</h1>
	</div>

	<div class="box-flex">
		<div class="button-full"><a href="/templates/index" class="btn-black left">View Templates</a></div>
		<div class="button-full"><a href="/products/index" class="btn-black">View Products</a></div>
		<div class="button-full"><a href="/templates/add" class="btn-black right">Create Templates</a></div>
	</div>

	<div class="cont1">
		<?php foreach($products as $product) : ?>
			<?php if(isset($product['Product']['id'])){ ?>
				<p>作品ID</p>
				<a href="/products/edit/<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['id']; ?></a>
				<p>作品名</p>	
				<p><?php echo $product['Product']['name']; ?></p>
				<?php echo $this->Form->postLink("", array('action' => 'delete',$product['Product']['id']),array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?>
			<?php } ?>
		<?php endforeach; ?>
	</div>
		
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
		<input id="add-product" type="submit" class="btn-green" value="Create" disabled />
	</form>
</div>
	

