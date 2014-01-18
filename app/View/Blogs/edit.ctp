<?php
	echo $this->Html->css('tag/tags_custom');
	echo $this->Html->css('diary');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>

<div class='form first-content-form'>
	<div class='cont'>
		<div class="form-headder">
			<h1>Edit Blog</h1>
		</div>
		<!-- ブログ投稿フォーム -->
		<?php echo $this->Form->create('Blog'); ?>
		
		<?php 
			echo $this->Form->input('title', array(
				'label'=>false, 
				'type'=>'text',
				'class'=>'input_form form-control',
				'value' => $post['Blog']['title'],
				// バリデーションのエラーメッセージを指定
				'error' => array(
					'isUnique' => __('そのユーザーIDは既に使われています', true),
					'custom' => __('半角英数字のみ使用できます', true),
					'minLength' => __('15文字以内で入力してください', true)))); 
					
			// タグフォーム
			echo $this->Form->input('Tag.namesCSV', array(
				'label'=>false, 
				'type'=>'text',
				'id'=>'tags',
				'name'=>'data[Tag][name]',
				'value' => $post['Tag']['namesCSV'],
				'class'=>'input_form')); 
		 
			echo $this->Form->input('Blog.content', array(
				'label'=>false, 
				'type'=>'textarea',
				'id'=>'ckeditor',
				'class'=>'input_form blog',
				'value' => $post['Blog']['content'],
				// バリデーションのエラーメッセージを指定
				'error' => array(
					'isUnique' => __('そのユーザーIDは既に使われています', true),
					'custom' => __('半角英数字のみ使用できます', true),
					'minLength' => __('15文字以内で入力してください', true)))); 
		?>
		<script type="text/javascript">  
			var editor = CKEDITOR.replace('ckeditor');  
		</script>

	</div>
	<div class="form-footer">
		<?php echo $this -> Form -> submit('Save', array('type' => 'submit', 'class' => 'btn-a')); ?>
		<?php echo $this -> Form -> end(); ?>	
	</div> <!-- footer -->
			
</div> <!-- form -->
<!-- JS tag -->
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
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			console.log('success');
			//tagbox
			$('#tags').tagbox({
			    url : tags.response,
    			lowercase : true
  			});
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>

			

