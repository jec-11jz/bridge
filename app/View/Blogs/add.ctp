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
			 	<select id="minbeds" class="list" name="data[Blog][spoiler]">
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5" selected>5</option>
				    <option value="6">6</option>
				    <option value="7">7</option>
				    <option value="8">8</option>
				    <option value="9">9</option>
				    <option value="10">10</option>
			 	</select>
			</div>
		</div> <!-- spoiler -->
		<div id='visibility'>
			<span>公開設定：</span>
		 	<select id="select-visibility" class="list" name="data[Blog][status]">
			    <option value="0" selected="selected">全員に公開</option>
			    <option value="1">友人に公開</option>
			    <option value="2">非公開</option>
		 	</select>
		</div> <!-- visibility -->


		<div class="form-editor">
		 	<textarea name="data[Blog][content]" id="ckeditor" class="input_form blog" cols="30" rows="6"></textarea>
		</div>
	 	
		<script type="text/javascript">var editor = CKEDITOR.replace('ckeditor');</script>

	</div>

		
	
	<div class="form-footer">
	 	<div class="div-submit submit-edit">
	 		<input type="submit" value="Save" class="btn-blue">
	 	</div>
	</div> <!-- footer -->

</form>
</div> <!-- form -->

