<?php
	$this->Html->css('mypage', null, array('inline' => false));
	$this->extend('/Common/index');
?>
<script>
$(function() {
	// get user's info
	$.ajax({
		tyep: 'GET',
		url: '/api/users/get_info.json',
		success: function(data){
			console.log(data['response']);
		},
		error: function(xhr, xhrStatus){
			
		}
	})
})
</script>

<div class="form second-content-form">
	<div class="form-header">
		<div class="header-left">
			<a href="/home/mypage" class="header-link">My page</a>
		</div>
		<div class="header-right">
			<span class="page-title user-name"><?php echo $user['name']; ?></span>
		</div>
		<div class="div-decoration">
			<span>Setting</span>
		</div>
	</div>

	<div class="box-flex">
		<div class="button-full"><a href="/blogs/index" class="btn-black blog">My Blogs</a></div>
		<div class="button-full"><a href="/products/index" class="btn-black product">My Products</a></div>
		<div class="button-full"><a href="/templates/index" class="btn-black template">My Templates</a></div>
	</div>
	<div class="button-full"><a href="/home/favorite" class="btn-black">My Favs</a></div>
	<div class="button-full"><a href="/image/index" class="btn-black">My images</a></div>
	<div class="button-full"><a href="/users/edit" class="btn-black">edit account</a></div>
	<div class="form-body">
		
	</div>
	<div class="form-footer">
		
	</div>
</div> <!-- form -->