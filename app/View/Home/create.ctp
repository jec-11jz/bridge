<?php
	$this->Html->css('mypage', null, array('inline' => false));
	$this->extend('/Common/index');
?>

<div class="form second-content-form">
	<div class="form-header">
		<div class="header-right">
			<span class="page-title user-name"><?php echo $user['name']; ?></span>
		</div>
	</div>
	
	<div class="form-body">
		<div class="div-create">
			<a class="create-button blog" href="/blogs/add">Blog</a>
			<a class="create-button product" href="/products/add">Product</a>
			<a class="create-button template" href="/templates/add">Template</a>
		</div>

	</div>
	<div class="form-footer">
		
	</div>
</div> <!-- form -->