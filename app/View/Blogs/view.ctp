<?php
	$this->extend('/Common/index');
	
	$this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));
	$this->Html->css('diary', null, array('inline' => false));

	$this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>
<script>
$(function() {
	// message setting
	(function($) {
	    $.fn.flash_message = function(options) {
	        //デフォルト値
	        options = $.extend({
	            text: 'Done',
	            time: 750,
	            how: 'before',
	            class_name: ''
	        }, options);
	
	        return $(this).each(function() {
	            //指定したセレクタを探して取得
	            if ($(this).parent().find('.flash_message').get(0)) return;
	
	            var message = $('<span />', {
	                'class': 'flash_message ' + options.class_name,
	                text: options.text
	            //フェードイン表示
	            }).hide().fadeIn('fast');
	
	            $(this)[options.how](message);
	            //delayさせてからフェードアウト
	            message.delay(options.time).fadeOut('normal', function() {
	                $(this).remove();
	            });
	
	        });
	    };
	})(jQuery);

	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#blog-tags").find('input.tag').click(function() {
				var tag_name = $(this).val();
				location.href = '/searches/index/?key_tags=' + tag_name;
			});
		}
	})(jQuery);
	
	function linkClick() {
		// confirm dialog
		$("#confirm-delete").click(function(){
			if(window.confirm('本当にいいんですね？')){
				location.href = $(this).attr('name');
			}
		});
		// add favorite
		$("#btn-favorite").click(function(){
			var blog_id = $('#div-view-blogs').attr('name');
			$.ajax({
				type: 'POST',
				url: '/api/blogs/add_favorites.json',
				data: {'blog_id': blog_id},
				success: function(data){
				    $('#fav-message').flash_message({
				        text: data['response'],
				        how: 'append'
				    });
				},
				error: function(xhr, xhrStatus){
					console.log(xhr);
				    $('#fav-message').flash_message({
				        text: xhr['responseJSON']['error']['message'],
				        how: 'append'
				    });
				}
			});
		});
		// delete favorite
		$("a.checked").click(function(){
			var blog_id = $('#div-view-blogs').attr('name');
			$.ajax({
				type: 'POST',
				url: '/api/blogs/delete_favorite.json',
				data: {'blog_id': blog_id},
				success: function(data) {
				    $('#fav-message').flash_message({
				        text: data['response'],
				        how: 'append'
				    });
				    location.reload();
				},
				error: function(xhr, xhrStatus){
					console.log(xhr);
				    $('#fav-message').flash_message({
				        text: xhr['responseJSON']['error']['message'],
				        how: 'append'
				    });
				}
			});
		});
	}
	// get tags from DB
	var blog_id = $('div.blog-form').attr('id');
	$.ajax({
		type: 'GET',
		url: '/api/blogs/view.json',
		data: {'id': blog_id},
		success: function(data){
			console.log(data['response']);
			// append tags
			tags = $('#js-tag').tmpl(data['response']['Tag']);
			$('#blog-tags').append(tags);
			// search from tag
			$(function() {
		    	$('.tag').searchFromTag();
			});
			// append tools
			tools = $('#js-tools').tmpl(data['response']);
			$('#tool-links').append(tools);
			linkClick();
			// append comments
			comments = $('#js-comments').tmpl(data['response']['Comment']);
			$('#comments').append(comments);
		},
		error: function(xhr, xhrStatus) {
			console.log(xhr);
			error = $('#error-message').tmpl(xhr['responseJSON']['error']);
			$('#message').append(error);
		}
	});
	// add view count
	var id = { data: $('#div-view-blogs').attr('name')};
	$.ajax({
		type: 'POST',
		url: '/api/blogs/add_count.json',
		data: id,
		success: function() {},
		error: function() {}
	});
	// get blog
	var blog_id = $('#div-view-blogs').attr('name');
	$.ajax({
		type: 'GET',
		url: '/api/blogs/get_blog_info.json',
		data: {'blog_id': blog_id},
		success: function(spoiler){
			console.log(spoiler);
			// append spoiler slider
			var select_spoiler = $('#js-spoiler').tmpl(spoiler['response']);
			$('#minbeds').append(select_spoiler);
			// slider width
			var sliderWidth = (spoiler['response']['spoiler'] - 1) * 10 + (spoiler['response']['spoiler'] - 1);
			$('#slider').find('div.ui-slider-range').css('width', sliderWidth + '%')
			$('#slider').find('a.ui-slider-handle').css('left', sliderWidth  + '%')
			// append visibility
			$('#select-visibility option').each(function(){
				if($(this).val() == spoiler['response']['status']){
					$(this).attr("selected",true)
				}
			})
		},
		error: function(xhr, xhrStatus){
			console.log('error');
		}
	});
	
	// add comment
	$('#btn-comment').click(function(){
		var arrayComment = {};
		arrayComment['data'] = {
			blog_id: $('#div-view-blogs').attr('name'),
			author: $('#comment-author').val(),
			url: $('#comment-url').val(),
			comment: $('#comment-content').val()
		};
		console.log(arrayComment);
		$.ajax({
			type: 'POST',
			url: '/api/blogs/comment.json',
			data: arrayComment,
			success: function(data){
			    $('#comment-message').flash_message({
			        text: data['response'],
			        how: 'append'
			    });
			},
			error: function(xhr, xhrStatus){
				$('#comment-message').flash_message({
			        text: xhr['responseJSON'],
			        how: 'append'
			    });
			}
		});
	});
	$("#comments").hide(0);
	$('#comment-list').click(function(){
		if($("#comment-icon").hasClass('fa-chevron-down')){
			$("#comments").show('fade',700);
			$("#comment-icon").removeClass('fa-chevron-down').addClass('fa-chevron-up');
		} else {
			$("#comments").hide('fade',700);
			$("#comment-icon").removeClass('fa-chevron-up').addClass('fa-chevron-down');
		}
	})
	
});
</script>
<!-- tag -->
<script id="js-tag" type="text/x-jquery-tmpl">
	<input type="button" class="tag btn-blue" value="${name}">
</script>
<!-- spoiler -->
<script id="js-spoiler" type="text/x-jquery-tmpl">
	<option value=${spoiler} selected>${spoiler}</option>
</script>
<!-- comment -->
<script id="js-comments" type="text/x-jquery-tmpl">
	<div class="user-comments">
		<div class="comment-sub">
			<p>${comment}</p>
		</div>
		<hr class="comment-division">
		<div class="comment-info-left">
			<span>${created}</span>
		</div>
		<div class="comment-info-right">
			<span class="span-author">${author}</span>
		</div>
	</div>
</script>
<!-- tools -->
<script id="js-tools" type="text/x-jquery-tmpl">
	
	<a href="/blogs/edit/${Blog.id}" class="fa fa-pencil-square-o"></a>
	
	{{if favorite != null}}
		<a class="fa fa-star checked"></a>
	{{else}}
		<a id="btn-favorite" class="fa fa-star"></a>
	{{/if}}
	<a name="/blogs/delete/${Blog.id}" class="fa fa-trash-o" id="confirm-delete"></a>
	<div id="fav-message" class="div-message"></div>
</script>

<!-- html -->
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
			<div id="tool-links" class="blog-tools"></div>
			<div class="spoiler">
				<div class="spoiler-slider">
					<span>ネタバレ：</span>
				 	<select name="minbeds" id="minbeds" class="list" disabled="disabled"></select>
				 	<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
						<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"></div>
						<a class="ui-slider-handle ui-state-default ui-corner-all"></a>
					</div>
				</div>
			</div> <!-- spoiler -->
			<div id='visibility'>
				<span>公開設定：</span>
			 	<select id="select-visibility" disabled="disabled">
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
			<div class="created-date">
				<span><?php echo h($blog['Blog']['created']); ?></span>
			</div>
			<div class="created-author">
				<span><a href="/users/view/<?php echo h($blog['User']['id']); ?>" class="btn-green"><?php echo h($blog['User']['name']); ?></a></span>
			</div>
		</div>
		<hr>
		<div id="comment-area" >
			<legend id="comment-list">コメント<i id="comment-icon" class="fa fa-chevron-down"></i></legend>
			<div id="comment-form">
				<div id="comments"></div>
				<div id="comment-message"></div>

				<h2>new comment</h2>
				<div class="new-comment">
					<textarea class="comment-index" id="comment-content" cols="40" rows="4" placeholder="comment"></textarea>
					<?php if(is_null($blog['login_user'])){ ?>
						<input type="text" class="comment-index" id="comment-author" placeholder="your name" />
						<input type="text" class="comment-index" id="comment-url" placeholder="url" />
					<?php } else { ?>
						
						<input type="text" class="comment-index input-author" id="comment-author" value="<?php echo h($blog['login_user']['name']) ?>" placeholder="your name" />
						<input type="text" class="comment-index input-url" id="comment-url" value="/users/view/<?php echo h($blog['login_user']['id']) ?>" placeholder="url" />
					<?php } ?>
					
					<button id="btn-comment" class="btn-blue">コメントする</button>
				</div>
				
			</div>
		</div>
	</div>
</div>
