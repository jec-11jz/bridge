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
	// message setting
	(function($) {
	    $.fn.flash_message = function(options) {
	        //デフォルト値
	        options = $.extend({
	            text: 'Done',
	            time: 1750,
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
	
	//テンプレートが選択されたらattributeを取得する
	$("#selected-template").change(function() {
		if($("#selected-template").val() == 'other'){
			window.open("/templates/add");
		}
		// delete all attribute
		$('.template-attributes').remove();
		var temp_id = $(this).val();
		$.ajax({
			type: 'GET',
			url: '/api/templates/get.json',
			data: {'id': temp_id},
			success: function(data){
				selected_template = $('#selectedAttributes').tmpl(data['response']['Attribute']);
				$('#template-attributes').append(selected_template);
				$('.tags').tagbox({
					url: tag,
    				lowercase: true
  				});
			},
			error: function(xhr, xhrStatus){
				$('#error-message').flash_message({
			        text: xhr['responseJSON']['error']['message'],
			        how: 'append'
			    });
				$('body,html').animate({
			        scrollTop: 0
			    }, 100);
			}
		});
	});// End change()
	
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
		// ajax
		$.ajax({
			type: "POST",
			url: "/api/products/edit.json",
			data: sendData,
			success: function(data){
		   　	location.href = "/products/index";
			},
			error: function(xhr, xhrStatus) {
			    $('#error-message').flash_message({
			        text: xhr['responseJSON']['error']['message'],
			        how: 'append'
			    });
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
		$('#attribute' + attrCnt).append('<input type="hidden" id="attribute' + attrCnt +'" class="post-tag tags attr-input">\n');

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
<script id="selectedAttributes" type="text/x-jquery-tmpl">
	<div id="${id}" class="attr template-attributes tags-set">
		<input id="${id}" class="form-control post-attribute tag-title" value="${name}">
		<input type="button" value="×" id="${id}" class="btn-delete-attribute attribute">
		<input type="hidden" class="post-tag attr-input tags" name="value" id="${id}">
	</div>
</script>

<div id="div-edit-products" class="form second-content-form">
	<form method="post" id="<?php echo h($product['Product']['id']); ?>" action="/products/edit/<?php echo h($product['Product']['id']); ?>">
		<div class="form-header">
			<div class="header-left">
				<a href="/products/index" class="header-link">Edit</a>
			</div>
			<div class="header-right">
				<input type="text" name="name" value="<?php echo h($product['Product']['name']); ?>" class="form-control product-info page-title" id="movieTitle"/>
			</div>
			<div class="div-decoration">
				<span>Products</span>
			</div>
		</div>
		
		<div id="error-message"></div>
		<div class="form-body">
			<div id="image" onclick="openKCFinder(this)">
				<?php if($product['Product']['image_url']) { ?>
					<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
				<?php } else { ?>
					<div style='margin:5px'>Click here to choose an image</div>
				<?php } ?>
			</div>
	
			<textarea name="outline" class="product-info body-outline edit" id="movie-outline" rows="12" cols="70" placeholder="あらすじ"><?php echo h($product['Product']['outline']); ?></textarea>	
			
			<div class="row">
				<select name="template_id" class="form-control template-name" id="selected-template" style="display:block">
					<option value=""　selected>-テンプレートを選択-</option>
					<?php foreach($product['Templates'] as $template) : ?>
						<?php if(isset($template['Template']['id'])){ ?>
							<?php if($template['Template']['id'] == $selected_template['Template']['id']) { ?>
								<option value="<?php echo $template['Template']['id']; ?>" selected><?php echo $template['Template']['name']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></option>
							<?php } ?>
						<?php } ?>
					<?php endforeach; ?>
					<option value="other">-テンプレートを作成-</option>
				</select>
			</div>
			
			<fieldset id="product-data">
				<div class="div-button">
					<button type="button" id="attribute" class="btn-add-attribute btn-blue add"><i class="fa fa-plus-circle"></i> add</button>
					<button type="button" id="btn-delete" class="button btn-danger del"><i class="fa fa-trash-o"></i> delete all</button>	
				</div>
				<div id="tags-attribute">
					<?php foreach($product['Attribute'] as $attribute) : ?>
						<div id="<?php echo h($attribute['id']); ?>" class="attr tags-set">
							<input id="<?php echo h($attribute['id']); ?>" class="form-control tag-title post-attribute" value="<?php echo h($attribute['name']); ?>">
							<input type="button" value="×" id="<?php echo h($attribute['id']); ?>" class="btn-delete-attribute attribute">
							<input type="hidden" class="post-tag attr-input tags" value="<?php echo h($attribute['Tag']['tagNamesCSV']); ?>" name="value" id="<?php echo h($attribute['id']); ?>">
						</div>
					<?php endforeach; ?>
					<div id="template-attributes"></div>
				</div>
			</fieldset>
		</div>
	
		<div class="form-footer">
			<div class="div-submit">
				<a href="/products/delete/<?php echo h($product['Product']['id']); ?>" name="" class="btn-danger">Delete</a>
				<input type="button" id="btn-register" class="btn-blue" value="登録" />
			</div>
		</div>
	</form>
</div>

<!-- </div> -->

