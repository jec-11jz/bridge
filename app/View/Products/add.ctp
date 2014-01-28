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
	
	//テンプレートが選択されたらattributeを取得する
	$("#selected-template").change(function() {
		$('.div-error').remove();
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
				error = $('#error-message').tmpl(xhr['responseJSON']['error']);
				$('#error').append(error);
				$('body,html').animate({
			        scrollTop: 0
			    }, 100);
			    return false;
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
			url: "/api/products/add.json",
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
			    console.log('send...' + sendData);
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
<script id="selectedAttributes" type="text/x-jquery-tmpl">
	<div id="${id}" class="div-attr template-attributes">
		<input id="${id}" class="post-attribute" value="${name}">
		<input type="text" class="post-tag attr-input tags" name="value" id="${id}">
		<input type="button" value="×" id="${id}" class="btn-delete-attribute attribute">
	</div>
</script>
<script id="error-message" type="text/x-jquery-tmpl">
	<div class="div-error">
		<h3 class="error">*${message}</h3>	
	</div>
</script>


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
.error {
	color: red;
}
#product-data {
	height: 12.000em;
	margin-top: 3.000em;
	overflow:scroll;
}
#input-attribute {
	overflow:scroll;
}
.div-attr {
	float:left
}
.attr-input {
	margin-right: 10px;
	width: 9.688em;
}
.template-name {
	clear: both;
}
</style>

<div class="form first-content-form">
	<div class="form-headder">
		<h1>Create Product</h1>
		<div id="error"></div>
	</div>
	<div id="formRegisterProduct">
		<form method="post" action="/products/add" class="content">

			<div class="div-title">
				<h4>Title</h4>
				<input type="text" name="name" class="input tags product-info" id="movieTitle"/>			
			</div>

			<div id="image" onclick="openKCFinder(this)"><div style='margin:5px'>Click here to choose an image</div></div>

			<textarea name="outline" class="product-info" cols="70" rows="12" id="movie-outline" placeholder="あらすじ"></textarea>

			<div class="row">
				<select name="template_id" class="form-control template-name" id="selected-template" style="display:block">
					<option value=""　selected>-テンプレートを選択-</option>
					<?php foreach($templates as $template) : ?>
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
				
			<!-- get attribute -->
			<fieldset id="product-data">
				<input type="button" value="add" id="attribute" class="btn-green btn-add-attribute add">
				<input type="button" id="btn-delete" class="btn-danger del" value="all delete" />
				<div id="input-attribute">
					<div id="template-attributes"></div>
				</div>
			</fieldset>		
			<div class="div-submit">
				<input type="button" id="btn-register" value="登録" class="btn-blue" />
			</div>
			
		</form>
	</div>
	<div class="form-footer">
		<a href="index" class="back">一覧へ戻る</a>
	</div>
</div>
	

