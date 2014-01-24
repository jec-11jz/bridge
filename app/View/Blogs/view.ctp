<?php
	$this->extend('/Common/index');
	
	echo $this->Html->css('diary');
	
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<div id="<?php echo h($blog['Blog']['id']); ?>" class="blog-form">
	<h2>タイトル</h2>
	<h1><?php echo h($blog['Blog']['title']); ?></h1>
	<hr>
	<h2>タグ</h2>
	<h4><div id="blog-tags"></div></h4>
	<hr>
	<h2>本文</h2>
	<p><?php echo $blog['Blog']['content']; ?></p>
	
	<!-- 作成日 -->
	<p><small>Created: <?php echo $blog['Blog']['created']; ?></small></p>
	<p><?php echo $blog['User']['name']; ?></p>
	</div>
<hr />
<a href="/blogs" style="display:block">投稿一覧へ戻る</a>
</div>
<script>
$(function() {
	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#blog-tags").find('input.tag').click(function() {
				tag_name = $(this).val();
				console.log(tag_name);
				$.ajax({
					type: 'GET',
					url: '/api/tags/search.json',
					data: {'value': tag_name},
					success: function(data){
						console.log(data);
						location.href = '/searches/index/?keywords=' + tag_name;
					},
					error: function(xhr, xhrStatus){
						
					}
				});
			});
		}
	})(jQuery);
	
	// $.fn.hoge.defaults = {
	    // fadeSpeed: 1000,
	    // hideEle: '#view'
	// };

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
		error: function(xhr, xhrStatus){
			error = $('#error-message').tmpl(xhr['responseJSON']['error']);
			$('#error').append(error);
		}
	});
	
});
</script>
<script id="js-tag" type="text/x-jquery-tmpl">
	<input type="button" class="tag" value="${name}">
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>