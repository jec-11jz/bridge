<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('tag/tags');
?>
<div id="head-all"></div>
<?php echo $this->Session->flash('tag'); ?>
<h1><?php echo $this->Html->link('index',array('controller' => 'tags', 'action'=>'index')); ?></h1>
<form method="post" id="TagAddForm" action="/tags/add">
	<input type="text" id="tags" name="data[Tag][name]" />
	<input type="submit" value="登録する" />
</form>
<script>
$(function() {
	$('#TagAddForm').ajaxForm({
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
				var errorBlock = $('#TagAddForm input[name="data[Tag]['+ key +']"]');
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
	