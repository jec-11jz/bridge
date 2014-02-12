<?php
	$this->extend('/Common/index');

	$this->Html->css('products', null, array('inline' => false));
	
	$this->Html->script('ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('tag/tags', array('inline' => false));
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

	<div class="products-index contents">
		<?php foreach($products as $product) : ?>
			<div class="cont1">
				<?php if(isset($product['Product']['id'])){ ?>
					<a href="/products/view/<?php echo $product['Product']['id']; ?>" class="link"></a>
					<a href="/products/view/<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['name']; ?></a>
					
					<?php echo $this->Form->postLink("", array('action' => 'delete',$product['Product']['id']),array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o delete')); ?>
				<?php } ?>
			</div>

		<?php endforeach; ?>
	</div>
		
</div>
	

