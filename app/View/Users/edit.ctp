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
	// get user's info
	$.ajax({
		tyep: 'GET',
		url: '/api/users/get_info.json',
		success: function(data){
			console.log(data['response']);
			var user_info = $('#js-user-edit').tmpl(data['response']);
			$('#edit-form').append(user_info);
		},
		error: function(xhr, xhrStatus){
			
		}
	});
	// change cover image
	$('#btn-edit-cover').click(function(event, data){
		window.KCFinder = {
	        callBack: function(url) {
	        	changeCover(url);
	        }
	    }
	    window.open('/js/kcfinder/browse.php?type=images&dir=images/public',
	        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
	        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
	    );
	});
	function changeCover(data){
		var src = {
			data: data
		};
		$.ajax({
			type: "POST",
			url: '/api/users/change_cover.json',
			data: src,
			success: function(data){
				location.reload();
			},
			error: function(xhr, xhrStatus){
				$('#message').flash_message({
			        text: xhr['responseJSON']['error'],
			        how: 'append'
		    	});
			}
		});
	}
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
})
</script>
<script id="js-user-edit" type="text/x-jquery-tmpl">
	<div id="${id}" class="field">
		<div id="image" onclick="openKCFinder(this)">
		{{if users_image != ""}}
			<img id="img" name="data[User][users_image]" src="${users_image}" width="100%" style="margin: auto; visibility: visible;">
		{{else}}
			<div style='margin:5px'>Click here to choose an image</div>
		{{/if}}
		</div>
		<span>Nickname</span>
		<input type="text" name="data[User][nickname]" class="user-info" id="user-nickname" placeholder="Nickname" value="${nickname}">
		<span>Email</span>
		<input type="text" name="data[User][email]" class="user-info" id="user-email" placeholder="email" value="${email}">
		<span>Profile</span>
		<textarea name="data[User][profile]" class="user-info" id="user-profile" cols="40" rows="5">${profile}</textarea>
	</div>
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

		</div>
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
				<a class="div-link" href="" onclick="openKCFinder(this)"></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>

			<div class="links-div div-edit div-checked">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>My Edit</span>
				</div>
			</div>

		</div>
		<div id="btn-edit-cover" class="btn-blue">カバー写真を変更する</div>
	</div>

	<div class="form-body">
		<div class="user-edit">
			<div id="message"></div>
			
			<form method="post" id="form-user-edit" action="/api/users/edit.json">
				<div id="edit-form">
				</div>
				<input type="button" id="btn-edit" class="btn-blue btn-submit" value="submit" />
			</form>

		</div> 
	</div>

	<div class="form-footer">
	</div>
</div> <!-- form -->

