<?php
	$this->extend('/Common/index');

	$this->Html->css('products', null, array('inline' => false));

	$this->Html->script('tag/tags', array('inline' => false));
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
?>
<script>
$(function(){
	// message setting
	(function($) {
	    $.fn.flash_message = function(options) {
	        //デフォルト値
	        options = $.extend({
	            text: 'Done',
	            time: 550,
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
	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#tags-attribute-view").find('input.tag').click(function() {
				var tag_name = $(this).val();
				location.href = '/searches/index/?key_tags=' + tag_name;
			});
		}
	})(jQuery);
	
	// add view count
	var id = { data: $('#div-view-products').attr('name')};
	$.ajax({
		type: 'POST',
		url: '/api/products/add_count.json',
		data: id,
		success: function() {},
		error: function() {}
	});
	
	// get tags from DB
	var product_id = $('#div-view-products').attr('name');
	$.ajax({
		type: 'GET',
		url: '/api/products/view.json',
		data: {'product_id': product_id},
		success: function(data){
			console.log(data['response']);
			// append tags
			tags = $('#js-tag').tmpl(data['response']['Attribute']);
			$('#tags-attribute-view').append(tags);
			// search from tag
			$(function() {
		    	$('.tag').searchFromTag();
			});
		},
		error: function(xhr, xhrStatus) {
			console.log(xhr);
		}
	});
	// add favorite
	$("#tool-links").find('.btn-favorite').click(function(){
		var product_id = $('#div-view-products').attr('name');
		var status = $(this).attr('name');
		$.ajax({
			type: 'POST',
			url: '/api/products/add_favorites.json',
			data: {
				'product_id': product_id,
				'status': status
			},
			success: function(data){
				$('#fav-message').flash_message({
			        text: data['response'],
			        how: 'append'
		    	});
			    $("#tool-links").find('a').removeClass('btn-favorite');
			},
			error: function(xhr, xhrStatus){
			    $('#fav-message').flash_message({
			        text: xhr['responseJSON'],
			        how: 'append'
			    });
			}
		})
	});
});
</script>
<script id="js-tag" type="text/x-jquery-tmpl">
	<div id="product-tags" class="tags-set">
		<span class="attributes tag-title">${name}</span>
		{{each Tag}}
			<input type="button" class="tag btn-blue" value="${this.name}">
		{{/each}}
	</div>
</script>



<div id="div-view-products" class="form second-content-form" name="<?php echo h($product['Product']['id']); ?>">
	<div class="form-header">
		<div class="header-left">
			<a href="/searches/index" class="header-link">View</a>
		</div>
		<div class="header-right">
			<span class="page-title"><?php echo h($product['Product']['name']); ?></span>
		</div>
		<div class="div-decoration">
			<span>Products</span>
		</div>
	</div>

	<div class="form-body">
		<div id="tool-links">
			<a name="2" class="btn-green btn-favorite btn-watched"><i class="fa fa-star"></i>Watched</a>
			<a name="1" class="btn-green btn-favorite btn-want"><i class="fa fa-star">Want</i></a>
			<div id="fav-message" class="div-message"></div>
		</div>
		<div id="image">
			<?php if($product['Product']['image_url']) { ?>
				<img id="img" src="<?php echo h($product['Product']['image_url']); ?>" width="100%" style="margin: auto; visibility: visible;">
			<?php } else { ?>
				<div style='margin:5px'>No image</div>
			<?php } ?>
		</div>

		<div class="body-outline outline-view">
			<p><?php echo h($product['Product']['outline']); ?></p>
		</div> 

		<div id="tags-attribute-view"></div>
	</div> <!-- form-body -->
		
	<div class="form-footer">
		<div class="div-submit">
			<a href="/products/edit/<?php echo $product['Product']['id']; ?>" class="btn-blue">Edit</a>
		</div>
	</div>

</form>
</div>

<!-- </div> -->

