<?php
	$this->extend('/Common/index');

	$this->Html->css('products', null, array('inline' => false));

	$this->Html->script('tag/tags', array('inline' => false));
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
		sendData['data']['Product']['id'] = $('#div-edit-products').find('form').attr('id');
		$('#div-edit-products').find('.product-info').each(function(){
			if($(this).val() != ""){
				sendData['data']['Product'][$(this).attr('name')] = $(this).val();
			} else {
				return;
			}
		});
		if(url.attr('src') != null){
			sendData['data']['Product']['image_url'] = url.attr('src');
		}
		// AttributeTags
		var cntTags = 0;
		sendData['data']['AttributeTag'] = {};
		$('#div-edit-products').find('.attr').each(function(){
			if($(this).find('.post-attribute').val() != ""){
				sendData['data']['AttributeTag'][cntTags] = {};
				sendData['data']['AttributeTag'][cntTags]['attribute'] = $(this).find('.post-attribute').val();
				sendData['data']['AttributeTag'][cntTags]['tag'] = $(this).find('.post-tag').val();
				cntTags++;
			}
		});
		console.log('send...');
		console.log(sendData);
		// ajax
		$.ajax({
			type: "POST",
			url: "/api/products/edit.json",
			data: sendData,
			success: function(data){
				console.log('get...');
				console.log(data);
		   // 　	location.href = "/products/index";
		  	},
			error: function(xhr, xhrStatus) {
				console.log('error...');
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
	// add attribute's form
	$(document).on('click', '.btn-add-attribute', function(){
		var attrCnt = 1;
		while($('#attribute' + attrCnt).size() > 0){
			attrCnt++;
		}
		$("#tags-attribute").append('<div id="attribute' + attrCnt + '" class="attr tags-set">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="form-control tag-title post-attribute attribute attr-input" name="data[Attribute][name][]">\n');
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

<div id="div-edit-products" class="form second-content-form">
	<form method="post" id="<?php echo h($product['Product']['id']); ?>" action="/products/edit/<?php echo h($product['Product']['id']); ?>">
		<div class="form-header">
			<div class="header-left">
				<a href="/products/index" class="header-link">Edit</a>
			</div>
			<div class="header-right">
				<input type="text" name="name" value="<?php echo h($product_names); ?>" class="form-control product-info page-title" id="movieTitle"/>
			</div>
			<div class="div-decoration">
				<span>Products</span>
			</div>
		</div>
	
		<div class="form-body">
			<div id="error"></div>
			
			<div id="image" onclick="openKCFinder(this)">
				<?php if($product['Product']['image_url']) { ?>
					<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
				<?php } else { ?>
					<div style='margin:5px'>Click here to choose an image</div>
				<?php } ?>
			</div>
	
			<textarea name="outline" class="product-info body-outline edit" id="movie-outline" rows="12" cols="70" placeholder="あらすじ"><?php echo h($product['Product']['outline']); ?></textarea>	
	
			<fieldset id="product-data">
				<div class="div-button">
					<button type="button" id="attribute" class="btn-add-attribute btn-blue add"><i class="fa fa-plus-circle"></i> add</button>
					<button type="button" id="btn-delete" class="button btn-danger del"><i class="fa fa-trash-o"></i> delete all</button>	
				</div>
				<div id="tags-attribute">
					<?php foreach($product['Attribute'] as $attribute) : ?>
						<div id="<?php echo h($attribute['id']); ?>" class="attr template-attributes tags-set">
							<input id="<?php echo h($attribute['id']); ?>" class="form-control tag-title post-attribute" value="<?php echo h($attribute['name']); ?>">
							<input type="button" value="×" id="<?php echo h($attribute['id']); ?>" class="btn-delete-attribute attribute">
							<input type="text" class="post-tag attr-input tags" value="<?php echo h($attribute['Tag']['tagNamesCSV']); ?>" name="value" id="<?php echo h($attribute['id']); ?>">
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
		</div>
	
		<div class="form-footer">
			<div class="div-submit">
				<input type="button" id="btn-register" class="btn-blue" value="登録" />
			</div>
		</div>
	</form>
</div>

<!-- </div> -->

