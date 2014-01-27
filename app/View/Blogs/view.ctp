<?php
	$this->extend('/Common/index');
	
	echo $this->Html->css('diary');
	
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<script>
$(function() {
	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#blog-tags").find('input.tag').click(function() {
				var tag_name = $(this).val();
				location.href = '/searches/index/?keywords=' + tag_name;
			});
		}
	})(jQuery);

	// get tags from DB
	var blog_id = $('div.blog-form').attr('id');
	$.ajax({
		type: 'GET',
		url: '/api/blogs/view.json',
		data: {'id': blog_id},
		success: function(data){
			tags = $('#js-tag').tmpl(data['response']['Tag']);
			$('#blog-tags').append(tags);
			// search product from tag
			$(function() {
		    	$('.tag').searchFromTag();
			});
		},
		error: function(xhr, xhrStatus) {
			error = $('#error-message').tmpl(xhr['responseJSON']['error']);
			$('#error').append(error);
		}
	});
});
</script>
<script id="js-tag" type="text/x-jquery-tmpl">
	<input type="button" class="tag btn-blue" value="${name}">
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>


<div id="div-create-blogs" class="form first-content-form">
	<div class="form-headder">
		<h1>View Blogs</h1>
	</div>

	<div class="contents">
		<div id="<?php echo h($blog['Blog']['id']); ?>" class="blog-form">
			<span class="title">タイトル</span>
			<h2><?php echo h($blog['Blog']['title']); ?></h2>
			<hr>
			<span>タグ:</span>
			<h4><div id="blog-tags"></div></h4>
			<hr>
			<h2>本文</h2>
			<p><?php echo $blog['Blog']['content']; ?></p>
			
			<!-- 作成日 -->
			<h5>Created: <?php echo $blog['Blog']['created']; ?></h5>
			<span><?php echo $blog['User']['name']; ?></span>
		</div>
	</div>

	<div class="form-footer">
		<a href="/blogs/edit/<?php echo h($blog['Blog']['id']); ?>" class="btn-a left">Edit</a>
		<a href="/blogs" style="display:block">投稿一覧へ戻る</a>
	</div>
</div>

