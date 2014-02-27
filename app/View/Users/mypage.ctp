<?php
	$this->extend('/Common/index');
	$this->Html->css('mypage', null, array('inline' => false));
	
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));

?>
<!-- KCfinder読み込み -->
<script type="text/javascript">
function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" name="data[User][users_image]" src="' + url + '" />';
                var img = document.getElementById('img');
                img.style.width = '100%';
                img.style.visibility = "visible";
            }
        }
    };
    window.open('/js/kcfinder/browse.php?type=images&dir=images/public',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>
<script type="text/javascript">
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
	
	// get user's info
	$.ajax({
		tyep: 'GET',
		url: '/api/users/get_info.json',
		success: function(data){
			console.log(data['response']);
			// user
			var user_info = $('#js-user-edit').tmpl(data['response']['User']);
			$('#edit-form').append(user_info);
			// blogs favorite
			var fav = $('#js-blogs-favorite').tmpl(data['response']['BlogsFavorite']);
			$('#blog-fav-list').append(fav);
			// products favorite
			var fav = $('#js-products-favorite').tmpl(data['response']['ProductsFavorite']);
			$('#product-fav-list').append(fav);
		},
		error: function(xhr, xhrStatus){
			
		}
	});
	
	// post user's info
	$('#btn-edit').click(function(){
		var postData = {};
		postData['data'] = {};
		postData['data']['User'] = {
			nickname: $("#user-nickname").val(),
			email: $("#user-email").val(),
			users_image: $("#img").attr('src'),
			profile: $("#user-profile").val()
		};
		$.ajax({
			type: "POST",
			url: '/api/users/edit.json',
			data: postData,
			success: function(data){
				$('#message').flash_message({
			        text: data['response'],
			        how: 'append'
		    	});
			},
			error: function(xhr, xhrStatus){
				$('#message').flash_message({
			        text: xhr['responseJSON']['error'],
			        how: 'append'
		    	});
			}
		});
	});

	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
})
</script>
<script id="js-user-edit" type="text/x-jquery-tmpl">
	<div id="${id}" class="field">
		<div id="image" onclick="openKCFinder(this)">
		{{if users_image != ""}}
			<img id="img" name="data[User][users_image]" src="${users_image}"  style="widthmargin: auto; visibility: visible;">
		{{else}}
			<div style='margin:5px'>Click here to choose an image</div>
		{{/if}}
		</div>
		<span>Nickname</span>
		<input type="text" name="data[User][nickname]" class="user-info" id="user-nickname" placeholder="Nickname" value="${nickname}">
		<span>Email</span>
		<input type="text" name="data[User][email]" class="user-info" id="user-email" placeholder="email" value="${email}">
		<span>Profile</span>
		<textarea name="data[User][profile]" class="user-info" id="user-profile" cols="40">${profile}</textarea>
	</div>
</script>
<script id="js-blogs-favorite" type="text/x-jquery-tmpl">
	<a class="blog-color" href="/blogs/view/${Blog.id}">${Blog.title}</a>
	${Blog.content}
	<span class="blog-color">${Blog.created}</span>

	<br>
</script>
<script id="js-products-favorite" type="text/x-jquery-tmpl">
	<a class="product-color" href="/products/view/${Product.id}">${Product.name}</a>
	<span class="product-color">${Product.created}</span>
	{{if Product.status == 1}}
		<span>観た！</span>
	{{else}}
		<span>観たい！</span>
	{{/if}}
	<br>
</script>



<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($loginInformation['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		<div class="header-user">
			<div class="user-potision">
				<div class="div-user-image">
					<a href="/users/mypage" class="link"></a>
					<img id="user-img" class="user-image" src="<?php echo h($loginInformation['User']['users_image']) ;?>" >
				</div>
				<div class="div-user-name">
					<span class="user-nickname"><?php echo h($loginInformation['User']['nickname']); ?></span>
					<span class="user-name">ID: <?php echo h($loginInformation['User']['name']); ?></span>
				</div>
			</div>
		</div><!-- header-user -->
		<div class="header-buttons">
			<div class="links-div div-fav">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav blogs</span>
				</div>
			</div>
			
			<div class="links-div div-products">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav products</span>
				</div>
			</div>
		
			
			<div class="links-div div-blogs">
				<a class="div-link" href="/blogs/index"></a>
				<div class="div-left">
					<i class="fa fa-book"></i>
				</div>
				<div class="div-right">
					<span>My blogs</span>
				</div>
			</div>
		
			<div class="links-div div-temp">
				<a class="div-link" href="/templates/index"></a>
				<div class="div-left">
					<i class="fa fa-th-list"></i>
				</div>
				<div class="div-right">
					<span>Template</span>
				</div>
			</div>
			
			<div class="links-div div-image">
				<a class="div-link" onclick="openKCFinder(this)"></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>

			<div class="links-div div-edit">
				<a class="div-link" href="/users/edit"></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>My Edit</span>
				</div>
			</div>
			
		</div><!-- header-buttons -->
	</div><!-- form-header -->

	<div class="form-body">
		<div id="fav-list">
			<div id="blog-fav-list" class="body-fav-blog">
				<p class="blog-color">Blog fav</p>
				<div id="blog-fav-list"></div>
			</div>

			<ul class="nav nav-tabs" id="fav-list">
			  <li class="active"><a href="#product-fav-list" data-toggle="tab">watched</a></li>
			  <li><a href="#want" data-toggle="tab">want</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="product-fav-list"></div>
			  <div class="tab-pane" id="want">...</div>
			</div>
			
		</div>



	</div><!-- form-body -->

	<div class="form-footer"></div>
</div> <!-- form -->

