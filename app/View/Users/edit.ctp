<?php
	$this->Html->css('mypage', null, array('inline' => false));
	
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
	
	$this->extend('/Common/index');
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
		<p>${name}</p>
		<div id="image" onclick="openKCFinder(this)">
		{{if users_image != ""}}
			<img id="img" name="data[User][users_image]" src="${users_image}" width="100%" style="margin: auto; visibility: visible;">
		{{else}}
			<div style='margin:5px'>Click here to choose an image</div>
		{{/if}}
		</div>
		<input type="text" name="data[User][nickname]" id="user-nickname" placeholder="Nickname" value="${nickname}">
		<input type="text" name="data[User][email]" id="user-email" placeholder="email" value="${email}">
		<textarea name="data[User][profile]" id="user-profile" cols="40">${profile}</textarea>
	</div>
</script>

<style>
	#image {
		width: 220px;
		height: 220px;
		color: white;
		background: black;
	}
</style>
<div class="form third-content-form">
	<div class="form-header">
		<!-- <img href="<?php echo $user[‘users_image’]; ?>"> -->
		<p><?php echo h($user[‘users_image’]); ?></p>
	</div>
	
	<div class="form-body">
	</div>

	<div class="form-footer">
	</div>
</div> <!-- form -->

<div class="user-edit">
	<div id="message"></div>
	<form method="post" id="form-user-edit" action="/api/users/edit.json">
		<div id="edit-form"></div>
		<div>
			<input type="button" id="btn-edit" class="btn-blue"value="submit" />
		</div>
	</form>
</div> <!-- END signup -->