<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<style type="text/css">
/*css of image*/
#image {
    width: 300px;
    height: 400px;
    overflow: hidden;
    cursor: pointer;
    background: #000000;
    color: #fff;
    line-height:400px; /* heightと同じ値 */
  	text-align:center;
  	vertical-align:middle;
}
#image img {
    visibility: hidden;
}
</style>
<div id="formRegisterProduct">
<form method="post" action="/products/add">
	<div id="image" onclick="openKCFinder(this)"><div style='margin:5px'>Click here to choose an image</div></div>
	<legend>テンプレート選択</legend>
	<select name="template_id" class="template-name product-info" id="selected-template" style="display:block">
		<option value=""　selected>--選択してください--</option>
		<?php foreach($templates as $template) : ?>
			<?php if(isset($template['Template']['id'])){ ?>
				<?php if($template['Template']['id'] == $selected_template['Template']['id']) { ?>
					<option value="<?php echo $template['Template']['id']; ?>" selected><?php echo $template['Template']['name']; ?></option>
				<?php } else { ?>
					<option value="<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></option>
				<?php } ?>
			<?php } ?>
		<?php endforeach; ?>
		<option value="other">テンプレート作成</option>
	</select>
	<label for="movieTitle">作品タイトル :</label>
	<input type="text" name="name" class="input product-info tags" id="movieTitle"/>
		
	<!-- アトリビュートの呼び出し -->
	<fieldset id="product-data">
		<table class="table">
			<th>Product Information</th>
			<?php if(!empty($selected_template)){ ?>
				<?php foreach($selected_template['Attribute'] as $template_attribute) : ?>
					<tr>
					<?php if(isset($template_attribute['name'])){ ?>
						<td><label for="<?php echo $template_attribute['id']; ?>"><?php echo $template_attribute['name']; ?> :</label>
						<input type="text" class="attribute tags" name="value" id="<?php echo $template_attribute['id']; ?>"></td>
					<?php } ?>
					</tr>
				<?php endforeach; ?>
			<?php } ?> <!-- end empty check -->
		</table>
	</fieldset>
	
	<label for="movie-outline">あらすじ：</label>
		<textarea name="outline" class="product-info" cols="40" rows="4" id="movie-outline" style="display: block" /></textarea>
		
	<label>最後の編集者 :</label><a style="display: block">iverson</a>
	<a>この作品を編集する</a>
	<input type="button" value="戻る" />
	<input type="button" id="btn-register" disabled value="登録" />
</form>
</div>
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
                div.innerHTML = '<img id="img" src="' + url + '" />';
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
<script>
$(function() {
	// DBからタグを取得
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			console.log('success');
			//tagbox
			$('.tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(tags){
			console.log('error');
		}
	});
	if($("#selected-template").val() != ""){
		$('#btn-register').removeAttr('disabled');
	}
	//テンプレートが選択されたら編集画面に飛ばす
	$("#selected-template").change(function() {
		var temp_id = $(this).val();
		console.log(temp_id);
		if(temp_id == 'other'){
			location.href="/templates/add";
			return;
		} else {
			location.href=encodeURI("/products/add?data=" + temp_id);
		}// End if()
	});// End change()
	
	//POSTデータをコントローラに渡す
	$("#btn-register").click(function() {
		var url = $("div#image").find("img");
		var sendData = {};
		sendData['data'] = {};
		// Product
		sendData['data']['Product'] = {};
		$('#formRegisterProduct').find('.product-info').each(function(){
			if($(this).val() != ""){
				sendData['data']['Product'][$(this).attr('name')] = $(this).val();
			}
		});
		if(url.attr('src') != null){
			sendData['data']['Product']['image_url'] = url.attr('src');
		}
		// AttributeTags
		var cntTags = 0;
		sendData['data']['AttributeTag'] = {};
		$('#formRegisterProduct').find('.attribute').each(function(){
			sendData['data']['AttributeTag'][cntTags] = {};
			sendData['data']['AttributeTag'][cntTags]['tag'] = $(this).val();
			sendData['data']['AttributeTag'][cntTags]['attribute_id'] = $(this).attr('id');
			cntTags++;
		});
		// ajax
		console.log(sendData['data']['Product']['template_id']);
		$.ajax({
			type: "POST",
			url: "/products/add",
			data: sendData,
			success: function(){
				window.location.reload();
			}
		});
	});
});
</script>
