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

<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back">
			<img src="<?php echo h($user['users_image']); ?>" alt="">
		</div>
		<div clasS="header-user">
			<h2><?php echo h($user['name']); ?></h2>
		</div>
		
	</div>

	<div class="box-flex">
		<div class="button-full"><a href="/blogs/index" class="btn-black blog">My Blogs</a></div>
		<div class="button-full"><a href="/templates/index" class="btn-black template">My Templates</a></div>
	</div>

	<div class="box-flex">
		<div class="button-full"><a href="/home/favorite" class="btn-black">My Favs</a></div>
		<div class="button-full"><a href="/image/index" class="btn-black">My images</a></div>
		<div class="button-full"><a href="/users/edit" class="btn-black">edit account</a></div>
	</div>
	
	<div class="form-body">
	
	</div>

	<div class="form-footer">
	</div>
</div> <!-- form -->