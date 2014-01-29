<?php
	echo $this->Html->css('jquery-ui-1.10.4.custom');
	echo $this->Html->css('diary');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('jquery-ui-1.10.4.custom');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>


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

<!-- スライダースクリプト -->
<script>
	$(function() {
	    var select = $( "#minbeds" );
	    var slider = $( "<div id='slider'></div>" ).insertAfter( select ).slider({
	      min: 1,
	      max: 10,
	      range: "min",
	      value: select[ 0 ].selectedIndex + 1,
	      slide: function( event, ui ) {
	        select[ 0 ].selectedIndex = ui.value - 1;
	      }
	    });
	    $( "#minbeds" ).change(function() {
	      slider.slider( "value", this.selectedIndex + 1 );
	    });
	});
</script>


<div id="div-edit-blogs" class='form second-content-form'>
	<div class="form-header">
		<div class="header-left">
			<span>Edit</span>
		</div>
		<div class="header-right">
			<span class="blog-title"</span>
		</div>
		<div class="div-decoration">
			<span>Blogs</span>
		</div>
	</div>
	<div class="form-body">
				<!-- ブログ投稿フォーム -->
		<form id="BlogEditForm"  action="/blogs/edit/<?php echo h($post['Blog']['id']); ?>" method="post">
			<input type="text" class="input_form form-control" value="<?php echo h($post['Blog']['title']); ?>">
			<input type="text" id="tags" name="data[Tag][name]" value="<?php echo h($post['Tag']['namesCSV']); ?>" class="input_form">

			<div class="spoiler">
				<div class="spoiler-slider">
					<span>ネタバレ：</span>
				 	<select name="minbeds" id="minbeds" class="list">
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					    <option>4</option>
					    <option selected>5</option>
					    <option>6</option>
					    <option>7</option>
					    <option>8</option>
					    <option>9</option>
					    <option>10</option>
				 	</select>
				</div>
			</div> <!-- spoiler -->

			<textarea id="ckeditor" class="input_form blog"><?php echo h($post['Blog']['content']); ?></textarea>
			<div class="div-submit">
				<input type="submit" value="Save" class="btn-blue">
			</div>
			
 		</form>


		<script type="text/javascript">  
			var editor = CKEDITOR.replace('ckeditor');  
		</script>
	</div>

	<div class="form-footer">
		<h5>Created: <?php echo h($post['Blog']['created']); ?></small><h5>
	</div> <!-- footer -->
</div> <!-- form -->
