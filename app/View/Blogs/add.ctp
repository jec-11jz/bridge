<?php
	
	echo $this->Html->css('jquery-ui-1.10.4.custom');
	echo $this->Html->css('diary');

	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('jquery-ui-1.10.4.custom');
	echo $this->Html->script('tag/tags');

	
	$this->extend('/Common/index');
?>

<div class="form first-content-form">
	<div class='cont'>
		<div class="form-headder">
			<h1>Create Blog</h1>
		</div>

		<!-- ブログ投稿フォーム -->
		<form id="BlogAddForm" method="post" action="/blogs/add">
			<input type="text" name="data[Blog][title]" class="input_form form-control" placeholder="title...">
			<input type="text" id="tags" class="input_form form-control" name="data[Tag][name]">
			<div style="clear:both"></div>
			<div class="spoiler">
				<div class="right">
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
		 	<textarea name="data[Blog][content]" id="ckeditor" class="input_form blog" cols="30" rows="6"></textarea>
		</form>

		<script type="text/javascript">  
			var editor = CKEDITOR.replace('ckeditor');  
		</script>
		
	</div> <!-- cont -->
	<div class="form-footer">
		<input type="submit" value="Save" class="btn-a">
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
