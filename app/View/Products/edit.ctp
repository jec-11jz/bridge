<?php
	echo $this->Html->css('products');

	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
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
			} else {
				console.log('aaaaaa');
				return;
			}
		});
		if(url.attr('src') != null){
			sendData['data']['Product']['image_url'] = url.attr('src');
		}
		// AttributeTags
		var cntTags = 0;
		sendData['data']['AttributeTag'] = {};
		$('#formRegisterProduct').find('.attr').each(function(){
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
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="form-control post-attribute attribute attr-input" name="data[Attribute][name][]">\n');
				$('#attribute' + attrCnt).append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-delete-attribute attribute">');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="post-tag tags attr-input">\n');

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
		$('.attr').remove();
	});
});
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>



<style type="text/css">
/*css of image*/
#image {
    visibility: hidden;
}
#product-data {
	height: 12.000em;
	margin-top: 3.000em;
	clear: both;
}
.form-button{
	clear: both;
}
</style>


<div class="form first-content-form">
	<div class="form-headder">
		<h1>Product Edit</h1>
	</div>

	<div id="formRegisterProduct">
		<div id="error"></div>

		<form method="post" id="<?php echo h($product['Product']['id']); ?>" action="/products/edit/<?php echo h($product['Product']['id']); ?>" class="content">
			<div class="div-title">
				<label for="movieTitle"><h5>title:</h5></label>
				<input type="text" name="name" value="<?php echo h($product_names); ?>" class="input product-info title tags" id="movieTitle"/>
			</div>


			<div id="image" onclick="openKCFinder(this)">
				<?php if($product['Product']['image_url']) { ?>
					<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
				<?php } else { ?>
					<div style='margin:5px'>Click here to choose an image</div>
				<?php } ?>
			</div>

			<textarea name="outline" class="product-info" id="movie-outline" rows="12" cols="70" placeholder="あらすじ"><?php echo h($product['Product']['outline']); ?></textarea>	

			<fieldset id="product-data">
				<input type="button" value="add" id="attribute" class="btn-green btn-add-attribute add">
				<input type="button" id="btn-delete" class="btn-danger del" value="all delete" />
				<div id="input-attribute">
					<?php foreach($product['Attribute'] as $attribute) : ?>
						<div id="${id}" class="attr template-attributes">
							<input id="<?php echo h($attribute['id']); ?>" class="form-control post-attribute" value="<?php echo h($attribute['name']); ?>">
							<input type="button" value="×" id="<?php echo h($attribute['id']); ?>" class="btn-delete-attribute attribute">
							<input type="text" class="post-tag attr-input tags" value="<?php echo h($attribute['Tag']['tagNamesCSV']); ?>" name="value" id="<?php echo h($attribute['id']); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
			<div class="form-button">
				<input type="button" id="btn-register" class="btn-green right" value="登録" />
				<input type="button" class="btn-green right" value="戻る" />
			</div>
		</form>
	</div>
</div>

<!-- </div> -->

