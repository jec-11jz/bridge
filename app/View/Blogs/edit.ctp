<?php
	$this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));
	$this->Html->css('diary', null, array('inline' => false));

	$this->Html->script('ckeditor/ckeditor', array('inline' => false));
	$this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false));
	$this->Html->script('tag/tags', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
	
	$this->extend('/Common/index');
?>

<!-- JS tag -->
<script>
$(function() {
	// confirm dialog
	$("#confirm-delete").click(function(){
		if(window.confirm('本当にいいんですね？')){
			location.href = $(this).attr('name');
		}
	});
	
	// get tags form DB
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			//tagbox
			$('#tags').tagbox({
			    url : tags.response,
    			lowercase : true
  			});
		},
		error: function(xhr, xhrStatus){
			console.log('tags are not found');
		}
	});
	
	// get blog
	var blog_id = $('#div-edit-blogs').attr('name');
	$.ajax({
		type: 'GET',
		url: '/api/blogs/get_blog_info.json',
		data: {'blog_id': blog_id},
		success: function(spoiler){
			// append spoiler slider
			var select_spoiler = $('#js-spoiler').tmpl(spoiler['response']);
			$('#minbeds').append(select_spoiler);
			// append visibility
			$('#select-visibility option').each(function(){
				if($(this).val() == spoiler['response']['status']){
					$(this).attr("selected",true)
				}
			})
			// slider
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
		},
		error: function(xhr, xhrStatus){
			console.log('error');
		}
	});
});
</script>
<script id="js-spoiler" type="text/x-jquery-tmpl">
	{{each count}}
		{{if spoiler == this + 1}}
			<option value=${this + 1} selected>${this + 1}</option>
		{{else}}
			<option value=${this + 1}>${this + 1}</option>
		{{/if}}
	{{/each}}
</script>
<!-- html -->
<div id="div-edit-blogs" class='form second-content-form' name="<?php echo h($post['Blog']['id']); ?>">
<form id="BlogEditForm"  action="/blogs/edit/<?php echo h($post['Blog']['id']); ?>" method="post">

	<div class="form-header">
		<div class="header-left">
			<a href="/searches/index" class="header-link">Edit</a>
		</div>
		<div class="header-right">
			<input type="text" name="data[Blog][title]" class="input_form form-control" value="<?php echo h($post['Blog']['title']); ?>" placeholder"Title...">
		</div>
		<div class="div-decoration">
			<span>Blogs</span>
		</div>
	</div>
	<div class="form-body">

		<input type="text" id="tags" name="data[Tag][name]" value="<?php echo h($post['Tag']['namesCSV']); ?>" class="input_form">
		<div class="blog-tools">
			<a href="/blogs/delete/"<?php echo h($post['Blog']['id']); ?> class="fa fa-trash-o" id="confirm-delete"></a>
		</div>

		<div class="spoiler">
			<div class="spoiler-slider">
				<span>ネタバレ：</span>
			 	<select id="minbeds" class="list" name="data[Blog][spoiler]"></select>
			</div>
		</div> <!-- spoiler -->
		<div id='visibility'>
			<span>公開設定：</span>
		 	<select id="select-visibility" class="list" name="data[Blog][status]">
			    <option value="0">全員に公開</option>
			    <option value="1">友人に公開</option>
			    <option value="2">非公開</option>
		 	</select>
		</div> <!-- visibility -->


		<div class="form-editor">
			<textarea id="ckeditor" name="data[Blog][content]" class="input_form blog"><?php echo h($post['Blog']['content']); ?></textarea>
		</div>

		<script type="text/javascript">var editor = CKEDITOR.replace('ckeditor');</script>
	</div>

	<div class="form-footer">
		<div class="div-created">
			<h5><?php echo h($post['Blog']['created']); ?></h5>
		</div>
		<div class="div-submit submit-edit">
			<input type="submit" value="Save" class="btn-blue">
		</div>
	</div> <!-- footer -->

</form>
</div> <!-- form -->
