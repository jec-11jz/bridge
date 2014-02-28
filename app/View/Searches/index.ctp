<?php
	$this->extend('/Common/index');
	
	$this->Html->css('searches', null, array('inline' => false));
	$this->Html->css('automatic/style', null, array('inline' => false));
	$this->Html->css('jquery-ui-1.10.4.custom', null, array('inline' => false));
	
	$this->Html->script('//ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('inline' => false));
	$this->Html->script('jquery-ui-1.10.4.custom', array('inline' => false));
	$this->Html->script('tag/tags', array('inline' => false));
	$this->Html->script('masonry.pkgd', array('inline' => false));
	$this->Html->script('imagesloaded', array('inline' => false));
	$this->Html->script('automatic/jquery.montage', array('inline' => false));
?>

<script>
$(function() {
	// get tags from DB
	var tag = [];
	$.ajax({
		type: 'GET',
		url: '/api/tags/get_most_used.json',
		success: function(tags){
			//tagbox
			$('.tags').tagbox({
			    url: tags.response,
    			lowercase: true
  			});
		},
		error: function(tags){
			console.log('tags error');
		}
	});
	
	// set arrayLoad
	var lastpage = false;
	var arrayLoad = {};
	arrayLoad = {
		page : 1, 
		count : 10, 
		keywords : $('#keywords').val(), 
		not_keywords : $('#not-keywords').val(),
		key_tags : $('#key-tags').val(),
		not_key_tags : $('#not-key-tags').val(),
		sort: $("#select-sort").val(),
	};
	
	function loadImage(arrayKeywords) {
		console.log('load...');
		console.log(arrayKeywords);
		$.ajax({
			type: 'GET',
			url: '/api/searches/search.json',
			data: {
				'count': arrayKeywords['count'],
				'page': arrayKeywords['page'],
				'keywords': arrayKeywords['keywords'],
				'not_keywords': arrayKeywords['not_keywords'],
				'key_tags': arrayKeywords['key_tags'],
				'not_key_tags': arrayKeywords['not_key_tags'],
				'sort': arrayKeywords['sort']
			},
			success: function(data, dataType) {
				console.log('get...');
				console.log(data);
				$("#related-tags").find(".related-tag").remove();
				if(data['response']['lastpage'] != null){
					lastpage = true;
				}
				// products
				products = $('#js-search-products').tmpl(data['response']['products']);
				$('#search-products-result').append(products);
				// blogs
				blogs = $('#js-search-blogs').tmpl(data['response']['blogs']);
				$('#search-blogs-result').append(blogs);
				// related tags
				tags = $('#js-related-tags').tmpl(data['response']['tags']);
				$('#related-tags').append(tags);
				$(function() {
			    	$('.related-tag').searchFromTag();
				});
				// loadImage
				$('#search-result').imagesLoaded(function() {
					$('.cont').removeClass('hidden');
					$('#search-result').masonry('appended', products);
					$('#search-result').masonry('appended', blogs);
					appendHide();
				});
				$("#btn-search").removeAttr("disabled");
			},
			error: function(xhr, xhrStatus) {
				error = $('#error-message').tmpl(xhr['responseJSON']['error']);
				$('#error').append(error);
				$("#btn-search").removeAttr("disabled");
			}
		});
	}
	
	// change sort
	$('#select-sort').change(function(){
		arrayLoad['sort'] = $('#select-sort').val();
		$("#btn-search").trigger("click");
	});
	
	var diary = $('#search-result');
	diary.masonry({
    	itemSelector: '.cont',
     	isAnimated: true,
		isFitWidth: true,
		columnWidth: 1
	});
	loadImage(arrayLoad);
	arrayLoad['page']++;
	// setTimeout("loadImage();", 2000);
	
	// scroll
	$(window).on('scroll', function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
			if(lastpage == false){
				// substitution value
				arrayLoad['keywords'] = $('#keywords').val();
				arrayLoad['not_keywords'] = $('#not-keywords').val();
				arrayLoad['key_tags'] = $('#key-tags').val();
				arrayLoad['not_key_tags'] = $('#not-key-tags').val();
				// execute　loadImage
				loadImage(arrayLoad);
				arrayLoad['page']++;
			}
		}
	});
	
	$("body").keypress( function( event ) {
		if( event.which === 13 ){
			$("#btn-search").trigger("click");
		}
	});

	// search
	$("#btn-search").click(function(){
		lastpage = false;
		$(this).attr("disabled", "disabled");
		$('.cont').remove();
		arrayLoad['page'] = 1;
		diary.masonry({
	    	itemSelector: '.cont',
	     	isAnimated: true,
			isFitWidth: true,
			columnWidth: 1
		});
		// substitution value
		arrayLoad['keywords'] = $('#keywords').val();
		arrayLoad['not_keywords'] = $('#not-keywords').val();
		arrayLoad['key_tags'] = $('#key-tags').val();
		arrayLoad['not_key_tags'] = $('#not-key-tags').val();
		// execute　loadImage
		loadImage(arrayLoad);
		arrayLoad['page']++;
	});
	
	// change checkbox
	function appendHide(){
		// blog
		if($('#check-blog').prop('checked')){
			for(var hideCnt = 10; hideCnt > $('#minbeds').val(); hideCnt--){
				$('#search-result').find('.spoiler' + hideCnt).hide();
			}
			for(var appendCnt = 1; appendCnt <= $('#minbeds').val(); appendCnt++){
				$('#search-result').find('.spoiler' + appendCnt).show();
			}
		} else {
			$('#search-result').find('.blog').hide();
		}
		// product
		if($('#check-product').prop('checked')){
			$('#search-result').find('.product').show();
		} else {
			$('#search-result').find('.product').hide();
		}
		// masonry
		diary.masonry({
	    	itemSelector: '.cont',
	     	isAnimated: true,
			isFitWidth: true,
			columnWidth: 1
		});
	}
	$('#check-blog').change(function(){
		if($("#check-blog-icon").hasClass('fa-check-square-o')){
			$("#check-blog-icon").removeClass('fa-check-square-o').addClass('fa-square-o');
		} else {
			$("#check-blog-icon").removeClass('fa-square-o').addClass('fa-check-square-o');
		}
		appendHide();
	});
	$('#check-product').change(function(){
		if($("#check-product-icon").hasClass('fa-check-square-o')){
			$("#check-product-icon").removeClass('fa-check-square-o').addClass('fa-square-o');
		} else {
			$("#check-product-icon").removeClass('fa-square-o').addClass('fa-check-square-o');
		}
		appendHide();
	});
	// click related tags
	// fn search from tag
	;(function($) {
		$.fn.searchFromTag = function() {
			$("#related-tags").find('.related-tag').click(function() {
				var tag_name = $(this).val();
				location.href = '/searches/index/?key_tags=' + tag_name;
			});
		}
	})(jQuery);
	// execute spoiler's slider
	var select = $( "#minbeds" );
    var slider = $( "<div id='slider'></div>" ).insertAfter( select ).slider({
      min: 1,
      max: 10,
      range: "min",
      value: select[ 0 ].selectedIndex + 1,
      slide: function( event, ui ) {
        select[ 0 ].selectedIndex = ui.value - 1;
        $("#minbeds").trigger("change");
      }
    });
    $( "#minbeds" ).change(function() {
    	slider.slider( "value", this.selectedIndex + 1 );
    	appendHide();
    });
});
</script>
<!-- product -->
<script id="js-search-products" type="text/x-jquery-tmpl">
	<div class="cont hidden product" style="float:left">
		<div class="div-decoration-products">
			<span>Product</span>
		</div>
		<div class="cont-pic">
			<a href="/products/view/${Product.id}" class="link"></a>
			{{if Product.image_url != ""}}
				<img src="${Product.image_url}" data-original="${Product.image_url}" class="cover" width="220px" height="auto">
			{{else}}
			<div class="div-noimage" style="width: 220px;height:220px">
			<i class="fa fa-camera-retro"></i>
			<p>No image</p>
				<div class="div-noimage-outline">${Product.outline.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,150) +"..."}</div>
			</div>

			{{/if}}
			<div class="cont-info">
				<p>${Product.name.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</p>
			</div>

		</div>
	</div>
</script>
<!-- blog -->
<script id="js-search-blogs" type="text/x-jquery-tmpl">
	<div class="cont hidden blog spoiler${Blog.spoiler}" style="float:left">
		<div class="div-decoration-blogs">
			<span>Blog</span>
		</div>
		<div class="cont-pic">
			<a href="/blogs/view/${Blog.id}" class="link"></a>
			{{if UsedBlogImage.length != 0}}
				<img src="${UsedBlogImage[0].url}" data-original="${UsedBlogImage[0].url}" class="cover" width="220px" height="auto">
			{{else}}
				<div class="div-noimage" style="width: 220px;height:220px">
					<i class="fa fa-camera-retro"></i>
					<p>No image</p>

					<div class="div-noimage-outline">
						${Blog.content.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,150) +"..."}
					</div>
				</div>
			{{/if}}
			<div class="cont-info">
				<p>${Blog.title.replace(/<("[^"]*"|'[^']*'|[^'">])*>/g,'').substring(0,27) +""}</p>
			</div>
		</div>
	</div>
</script>
<!-- related tags -->
<script id="js-related-tags" type="text/x-jquery-tmpl">
	<input type="button" class="related-tag tag" value="${Tag.name}">
</script>



<div id="search">
	<div class="div-search">
		<input name="keywords" id="keywords" class="form-control main-search" value="<?php echo h($keyword); ?>" placeholder='Search  here...'>
		<input type="submit" value="Search" class="btn-green button-search" id="btn-search">
		<input type="hidden" name="not-keywords" id="not-keywords" class="form-control" placeholder="not検索">
	</div>

	<div id="search-custom">
		<div class="form-tag">
			Tag Search<input type="hidden" name="key-tags" id="key-tags" class="form-control tags" value="<?php echo h($key_tags['keywords']); ?>">
			Not<input type="hidden" name="not-key-tags" id="not-key-tags" class="form-control tags">
		</div>
		<div class="form-checkbox">
			<input type="checkbox" name="blog" value="Blog" id="check-blog" class="checkbox-blog" checked="checked">
			<label for="check-blog" class="label-checkbox-blog"><i id="check-blog-icon" class="fa fa-check-square-o"></i> BLOG</label>
			<input type="checkbox" name="product" value="Product" id="check-product" class="checkbox-product" checked="checked">
			<label for="check-product" class="label-checkbox-product"><i id="check-product-icon" class="fa fa-check-square-o"></i> PRODUCT</label>
		</div>
		<div class="spoiler">
			<div class="right">
				<span>ネタバレ:</span>
			 	<select name="minbeds" id="minbeds" class="list">
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5" selected>5</option>
				    <option value="6">6</option>
				    <option value="7">7</option>
				    <option value="8">8</option>
				    <option value="9">9</option>
				    <option value="10">10</option>
			 	</select>
			</div>
		</div><!-- spoiler -->
		<div id="related-tags"></div>

	</div><!-- search-custom -->
</div><!-- search -->


<hr>
<div class="div-sort">
	<span>並び替え：</span>
 	<select id="select-sort" class="sort-list">
	    <option value="created DESC" selected="selected">新着順</option>
	    <option value="created ASC">古い順</option>
	    <option value="access_count DESC">人気順</option>
	    <option value="access_count ASC">人気がない順</option>
 	</select>
</div><!-- sort -->

<div id="search-result">
	<div id="search-blogs-result"></div>
	<div id="search-products-result"></div>
</div>




