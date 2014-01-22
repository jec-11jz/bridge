<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>
<style type="text/css">
/*css of image*/
#image {
    width: 18.750em;
    height: 25.000em;
    overflow: hidden;
    background: #222;
    color: #fff;
    line-height:25.000em; /* heightと同じ値 */
  	text-align:center;
  	vertical-align:middle;
  	float: left;
  	margin-right: 5.000em;
}
#image img {
    visibility: hidden;
}
.error {
	color: red;
}
#product-data {
	height: 12.000em;
	margin-top: 3.000em;
	overflow:scroll;
	clear: both;
}
#input-attribute {
	overflow:scroll;
}
.div-attr {
	float:left
}
.product-title {
	width: 80%;
	height: 3.000em;
	margin-bottom: 4.000em;
}
.attr-input {
	margin-right: 10px;
	width: 9.688em;
}
</style>
<div id="formRegisterProduct">
	<form method="post" id="<?php echo h($product['Product']['id']); ?>" action="/products/edit/<?php echo h($product['Product']['id']); ?>">
		<div id="error"></div>
		<!-- product name -->
		<div>
			<label for="movieTitle"><h4>title</h4></label>
			<input type="text" name="name" value="<?php echo h($product_names); ?>" class="input product-info product-title tags" id="movieTitle"/>
		</div>
		<!-- product image -->
		<div id="image" onclick="openKCFinder(this)">
			<?php if($product['Product']['image_url']) { ?>
				<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
			<?php } else { ?>
				<div style='margin:5px'>Click here to choose an image</div>
			<?php } ?>
		</div>
		<!-- product outline -->
		<label for="movie-outline">あらすじ：</label>
		<textarea name="outline" class="product-info" cols="40" rows="4" id="movie-outline" style="display: block" /><?php echo h($product['Product']['outline']); ?></textarea>	
		<!-- get attribute -->
		<fieldset id="product-data">
			<input type="button" value="add" id="attribute" class="btn-add-attribute">
			<input type="button" id="btn-delete" class="button" value="all delete" />
			<div id="input-attribute">
				<?php foreach($product['Attribute'] as $attribute) : ?>
					<div id="${id}" class="div-attr template-attributes">
						<input id="<?php echo h($attribute['id']); ?>" class="post-attribute" value="<?php echo h($attribute['name']); ?>">
						<input type="text" class="post-tag attr-input tags" value="<?php echo h($attribute['Tag']['tagNamesCSV']); ?>" name="value" id="<?php echo h($attribute['id']); ?>">
					</div>
				<?php endforeach; ?>
			</div>
		</fieldset>
		<input type="button" value="戻る" />
		<input type="button" id="btn-register" value="登録" />
	</form>
	<label>最後の編集者 :</label><a>iverson</a>
	<a>この作品を編集する</a>
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
	tag = null;
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			tag = tags.response;
			//tagbox
			$('.tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(xhr, xhrStatus){
			$('.div-error').remove();
			error = $('#error-message').tmpl(xhr['responseJSON']['error']);
			$('#error').append(error);
			$('body,html').animate({
		        scrollTop: 0
		    }, 100);
		    return false;
		}
	});
	
	//POSTデータをコントローラに渡す
	$("#btn-register").click(function() {
		var url = $("div#image").find("img");
		var sendData = {};
		sendData['data'] = {};
		// Product
		sendData['data']['Product'] = {};
		sendData['data']['Product']['id'] = $('#formRegisterProduct').find('form').attr('id');
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
		$('#formRegisterProduct').find('.div-attr').each(function(){
			if($(this).find('.post-attribute').val() != ""){
				sendData['data']['AttributeTag'][cntTags] = {};
				sendData['data']['AttributeTag'][cntTags]['attribute'] = $(this).find('.post-attribute').val();
				sendData['data']['AttributeTag'][cntTags]['tag'] = $(this).find('.post-tag').val();
				cntTags++;
			}
		});
		// ajax
		$.ajax({
			type: "POST",
			url: "/api/products/edit.json",
			data: sendData,
			success: function(data){
			   　location.href = "/products/index";
			},
			error: function(xhr, xhrStatus) {
				$('.div-error').remove();
				error = $('#error-message').tmpl(xhr['responseJSON']['error']);
				$('#error').append(error);
				$('body,html').animate({
			        scrollTop: 0
			    }, 100);
			    return false;
			}
		});
	});
});
</script>
<script>
$(function(){
	// attribute's form add
	$(document).on('click', '.btn-add-attribute', function(){
		var attrCnt = 1;
		while($('#attribute' + attrCnt).size() > 0){
			attrCnt++;
		}
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="div-attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="post-attribute attribute attr-input" name="data[Attribute][name][]">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="post-tag tags attr-input">\n');
		$('#attribute' + attrCnt).append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-delete-attribute attribute">\n');
		$('.tags').tagbox({
			url: tag,
    		lowercase: true
  		});
	});
	// attribute's form delete
	$(document).on('click', '.btn-delete-attribute', function(){
		attrID = $(this).attr('id');
		$("div#" + attrID).remove();
	});
	// delete all attribute's form
	$('#btn-delete').click(function() {
		$('.div-attr').remove();
	});
});
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>
