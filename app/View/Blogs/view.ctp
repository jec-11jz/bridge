<?php
	$this->extend('/Common/index');
	
	$this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));
	$this->Html->css('diary', null, array('inline' => false));

	$this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>

<script>
$(function() {
	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#blog-tags").find('input.tag').click(function() {
				var tag_name = $(this).val();
				location.href = '/searches/index/?key_tags=' + tag_name;
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
	
	// confirm dialog
	$("#confirm-delete").click(function(){
		if(window.confirm('本当にいいんですね？')){
			location.href = $(this).attr('name');
		}
	});
	
	// get blog
	var blog_id = $('#div-view-blogs').attr('name');
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
<script id="js-tag" type="text/x-jquery-tmpl">
	<input type="button" class="tag btn-blue" value="${name}">
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>
<script id="js-spoiler" type="text/x-jquery-tmpl">
	{{each count}}
		{{if spoiler == this + 1}}
			<option value=${this + 1} selected>${this + 1} </option>
		{{else}}
			<option value=${this + 1}>${this + 1}</option>
		{{/if}}
	{{/each}}
</script>

<div id="div-view-blogs" class="form second-content-form" name="<?php echo h($blog['Blog']['id']); ?>">
	<div class="form-header">
		<div class="header-left">
			<a href="/searches/index" class="header-link">View</a>
		</div>
		<div class="header-right">
			<span class="page-title"><?php echo h($blog['Blog']['title']); ?></span>
		</div>
		<div class="div-decoration"><span>Blogs</span></div>
	</div>

	<div class="form-body">
		<div id="<?php echo h($blog['Blog']['id']); ?>" class="blog-form">

			<div id="blog-tags"></div>
			<div class="blog-tools">
				<a href="/blogs/edit/<?php echo h($blog['Blog']['id']); ?>" class="fa fa-pencil-square-o"></a>
				<a href="/blogs/view/<?php echo h($blog['Blog']['id']); ?>" class="fa fa-desktop">
				<a href="#" class="fa fa-star">
				<a name="/blogs/delete/<?php echo h($blog['Blog']['id']); ?>" class="fa fa-trash-o" id="confirm-delete"></a>
			</div>
			<div class="spoiler">
				<div class="spoiler-slider">
					<span>ネタバレ：</span>
				 	<select name="minbeds" id="minbeds" class="list" disabled="disabled"></select>
				</div>
			</div> <!-- spoiler -->
			<div id='visibility'>
				<span>公開設定：</span>
			 	<select id="select-visibility" class="list" disabled="disabled">
				    <option value="0">全員に公開</option>
				    <option value="1">友人に公開</option>
				    <option value="2">非公開</option>
			 	</select>
			</div> <!-- visibility -->
			<hr>
			<div class="text-body">
				<?php echo $blog['Blog']['content']; ?>
			</div>
			
		</div>
	</div>

	<div class="form-footer">
		<hr>
		<div class="div-created">
			<span><?php echo h($blog['Blog']['created']); ?></span>
			<span><?php echo h($blog['User']['name']); ?></span>
		</div>

	</div>
</div>

