<?php
	$this->extend('/Common/index');

	$this->Html->css('mypage', null, array('inline' => false));
	
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
	
	// get user's blog
	var user_id = $('#user-info').attr('name');
	$.ajax({
		type: 'GET',
		url: '/api/blogs/get_user_blogs.json',
		data: {'user_id': user_id},
		success: function(data){
			console.log(data['response']);
			var user_blogs = $('#js-user-blogs').tmpl(data['response']);
			$('#user-blogs').append(user_blogs);
		},
		error: function(xhr, xhrStatus){
			console.log(xhr);
		}
	});
	
	// add favorite
	$("#user-info").find('.btn-favorite').click(function(){
		var user_id = $('#user-info').attr('name');
		$.ajax({
			type: 'POST',
			url: '/api/users/add_favorites.json',
			data: {'user_id': user_id},
			success: function(data){
				$('#message').flash_message({
			        text: data['response'],
			        how: 'append'
		    	});
			    $("#user-info").find('a').removeClass('btn-favorite');
			},
			error: function(xhr, xhrStatus){
				console.log(xhr);
			    $('#message').flash_message({
			        text: xhr['responseJSON']['error']['message'],
			        how: 'append'
			    });
			}
		});
	});
});
</script>
<script id="js-user-blogs" type="text/x-jquery-tmpl">
	<div>
		{{each No}}
		<div>
			<img style="width: 100px; height: auto;" src="${UsedBlogImage[0].url}">
			<span style="float: left; width: 32.250em;"><a href="/blogs/view/${Blog.id}">${Blog.title}</a></span>
			<span>${Blog.created}</span>
		</div>
		{{/each}}
	</div>
</script>
<style>
	#user-img {
		width: 220px;
		heigth: 220px;
	}
</style>
<div id="user-info" name="<?php echo h($user_info['User']['id']) ;?>">
	<p><?php echo h($user_info['User']['name']) ;?></p>
	<img id="user-img" src="<?php echo h($user_info['User']['users_image']) ;?>" >
	<p><?php echo h($user_info['User']['profile']) ;?></p>
	<div id="message"></div>
	<?php if(is_null($user_info['favorite']) && $user_info['auth'] == 'others'){ ?>
		<a class="fa fa-star btn-favorite"></a>
	<?php } else { ?>
		<a class="fa fa-star" disabled="disabled"></a>
	<?php } ?>
	<legend>ブログ一覧</legend>
	<div id="user-blogs"></div>
</div>

<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($loginInformation['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		</div>
		<div clasS="header-user">
			<span><?php echo h($user['name']); ?></span>
		</div>
		<div class="header-buttons">
			<div class="user-links">
				<div class="links-div div-fav">
					<a class="div-link" href=""></a>
					<div class="div-left">
						<i class="fa fa-star-o"></i>
					</div>
					<div class="div-right">
						<span>frend request</span>
					</div>
				</div>
<!-- 				<div class="links-div div-watched">
					<a class="div-link" href=""></a>
					<div class="div-left">
						<i class="fa fa-star-o"></i>
					</div>
					<div class="div-right">
						<span>Watched</span>
					</div>
				</div>
				<div class="links-div div-want">
					<a class="div-link" href=""></a>
					<div class="div-left">
						<i class="fa fa-star-o"></i>
					</div>
					<div class="div-right">
						<span>Want to watch</span>
					</div>
				</div> -->
			</div>
		</div>
		
	</div>
<!--  -->
	<div class="form-body">
		

	</div>

	<div class="form-footer">
	</div>
</div> <!-- form -->

