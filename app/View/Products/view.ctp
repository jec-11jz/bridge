<?php
	$this->extend('/Common/index');

	$this->Html->css('products', null, array('inline' => false));

	$this->Html->script('tag/tags', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>


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
		sendData['data']['Product']['id'] = $('#div-view-products').find('form').attr('id');
		$('#div-view-products').find('.product-info').each(function(){
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
		$('#div-view-products').find('.attr').each(function(){
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
		$("#tags-attribute").append('<div id="attribute' + attrCnt + '" class="attr">\n');
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
.form-button{
	clear: both;
}
</style>


<div id="div-view-products" class="form second-content-form">
<form method="post" id="<?php echo h($product['Product']['id']); ?>" action="/products/edit/<?php echo h($product['Product']['id']); ?>">

	<div class="form-header">
		<div class="header-left">
			<a href="/products/index" class="header-link">View</a>
		</div>
		<div class="header-right">
			<span class="page-title"><?php echo h($product['Product']['name']); ?></span>
		</div>
		<div class="div-decoration">
			<span>Products</span>
		</div>
		
	</div>

	<div class="form-body">
		<div id="error"></div>
		<div id="image">
			<?php if($product['Product']['image_url']) { ?>
				<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
			<?php } else { ?>
				<div style='margin:5px'>No image</div>
			<?php } ?>
		</div>

		<div class="body-outline">
			<p><?php echo h($product['Product']['outline']); ?></p>
		</div> 

		<div id="tags-attribute">
			<?php foreach($product['Attribute'] as $attribute) : ?>
				<div id="blog-tags" class="tags-set">
					<span class="tag-title"><?php echo h($attribute['name']); ?></span>
					<span class="tag btn-blue"><?php echo h($attribute['Tag']['tagNamesCSV']); ?></span>	
				</div>

			<?php endforeach; ?>
		</div>
	</div> <!-- form-body -->
		
		
	
	<div class="form-footer">
		<a href="/products/edit/<?php echo $product['Product']['id']; ?>" class="btn-blue">Edit</a>
	</div>

</form>
</div>

<!-- </div> -->

