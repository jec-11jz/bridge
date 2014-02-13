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
			<span><?php echo h($user['name']); ?></span>
		</div>
		
	</div>

	<div class="form-body">
		<div class="user-links">
			<div class="links-div div-fav">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>My Favs</span>
				</div>
			</div>
			<div class="links-div div-watched">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Watched</span>
				</div>
			</div>
			<div class="links-div div-want">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Want to watch</span>
				</div>
			</div>
			<div class="links-div div-temp">
				<a class="div-link" href="/templates/index"></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>Template</span>
				</div>
			</div>
			<div class="links-div div-image">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>
			<div class="links-div div-edit">
				<a class="div-link" href="/users/edit"></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>edit account</span>
				</div>
			</div>
		</div>
	</div>

	<div class="form-footer">
	</div>
</div> <!-- form -->