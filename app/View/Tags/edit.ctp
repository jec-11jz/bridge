<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<p><h1>使用タグ</h1></p>
<form method="post" id="TagEditForm" action="/tags/edit">
	<input type="text" id="tags" class="input_form" name="data[Tag][name]" value="<?php echo h($tags) ?>" />
	<input type="submit" value="登録する" />
</form>
<script>
$(function() {
	$('#TagEditForm').ajaxForm({
		success: function(data) {
			if (!data.errors) {
				// success
				location.reload();
				return;
			}
			
			// error
			$.each(data.errors, function(key, error){
				console.log('key:'+ key);
				console.log('error: '+ error);
				var errorBlock = $('#TagEditForm input[name="data[Tag]['+ key +']"]');
				errorBlock.closest('.form-group').addClass('has-error');
				errorBlock.after('<span class="help-block">'+ error +'</span>');
			});
		},
		error: function(data) {
			console.log(data);
			alert('connection error');
			return;
		}
	});
	// DBからタグを取得
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/tags/get',
		success: function(tags){
			console.log('success');
			//tagbox
			$('#tags').tagbox({
			    url : JSON.parse(tags),
    			lowercase : true
  			});
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>
