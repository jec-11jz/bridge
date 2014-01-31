<?php
	$this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));
	$this->Html->css('diary', null, array('inline' => false));

	$this->Html->script('ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false));
	$this->Html->script('tag/tags', array('inline' => false));

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
	// get tags from DB
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			console.log('success');
			//tagbox
			$('#tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(tags){
			console.log('error');
		}
	});
});
</script>

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



<div id="div-add-blogs" class="form second-content-form">
<form id="BlogAddForm" method="post" action="/blogs/add">

	<div class="form-header">
		<div class="header-left">
			<a href="/searches/index" class="header-link">Create</a>
		</div>
		<div class="header-right">
			<input type="text" name="data[Blog][title]" class="input_form form-control form-title" placeholder="Title...">
		</div>
		<div class="div-decoration">
			<span>Blogs</span>
		</div>
	</div>

	<div class="form-body">
		<!-- ブログ投稿フォーム -->
		<input type="text" id="tags" class="input_form form-control" name="data[Tag][name]" placeholder="Tags...">
		<div style="clear:both"></div>
		<div class="spoiler spoiler-add">
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


		<div class="form-editor">
		 	<textarea name="data[Blog][content]" id="ckeditor" class="input_form blog" cols="30" rows="6"></textarea>
		</div>
	 	
		<script type="text/javascript">var editor = CKEDITOR.replace('ckeditor');</script>

	</div>

		
	
	<div class="form-footer">
	 	<div class="div-submit submit-edit">
	 		<input type="submit" value="Save" class="btn-blue">
	 	</div>
		<a href="/searches/index" class="index-back"><i class="fa fa-reply"></i> 一覧へ</a>
	</div> <!-- footer -->

</form>
</div> <!-- form -->

