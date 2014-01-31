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
				location.href = '/searches/index/?keywords=' + tag_name;
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

<div id="div-view-blogs" class="form second-content-form">
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
				<a href="/blogs/delete/<?php echo h($blog['Blog']['id']); ?>" class="fa fa-trash-o"></a>
			</div>
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
			<hr>
			<div class="text-body">
				
				<?php echo $blog['Blog']['content']; ?>
			</div>
			
		</div>
	</div>

	<div class="form-footer">
		<hr>
		<div class="div-created">
			<span><?php echo $blog['Blog']['created']; ?></span>
			<span><?php echo $blog['User']['name']; ?></span>
		</div>

	</div>
</div>

