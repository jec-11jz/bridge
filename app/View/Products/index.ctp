<?php
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
		<div class="button-full"><a href="/products/index" class="btn-black left">View Products</a></div>
		<div class="button-full"><a href="/products/add" class="btn-black">Create Products</a></div>
		<div class="button-full"><a href="/templates/add" class="btn-black right">Create Templates</a></div>
	</div>

	<div class="products-index">
		<?php foreach($products as $product) : ?>
			<div class="cont1 contents">
				<?php if(isset($product['Product']['id'])){ ?>
					<a href="/products/edit/<?php echo $product['Product']['id']; ?>" class="link"></a>
					<p>作品名</p>	
					<a href="/products/edit/<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['name']; ?></a>
					
					<?php echo $this->Form->postLink("", array('action' => 'delete',$product['Product']['id']),array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o delete')); ?>
				<?php } ?>
			</div>

		<?php endforeach; ?>
	</div>
		
</div>
	

