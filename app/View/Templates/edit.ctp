<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
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
#add-attributes {
	height: 25.000em;
	margin-top: 3.000em;
	overflow:scroll;
	
}
#input-attribute {
	overflow:scroll;
}
#new-template {
	margin-bottom: 1.875em;
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
.clearFix {
	clear: both;
	display: block;
}
.btn-delete-attribute {
	width: 24px;
	height: 24px;
	color: #FFF;
	margin-right: 4.000em;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0.00, #000), color-stop(1.00, #303030));
	background: -webkit-linear-gradient(#111, #303030);
	background: -moz-linear-gradient(#111, #303030);
	background: -o-linear-gradient(#111, #303030);
	background: -ms-linear-gradient(#111, #303030);
	background: linear-gradient(#111, #303030);
}
.attribute {
	margin-bottom: 1.875em;
	margin-top: 1.875em;
}
.textarea {
	margin-top: 3.125em;
	width: 100%;
}
.form-template {
	padding: 3.125em 0px 0px 3.125em;
}
input.template-name {
	width: 40%;
	height: 3.000em;
}
.submit {
	text-align: right;
}
.btn-register {
	margin: 1.875em 1.875em 1.875em 0;
}
.link {
	margin-left: 1.875em;
}
input:focus {
	border: solid #5FFDA3 1px;
	-moz-border-radius: 1px;
	box-shadow(rgba(0, 0, 0, .15) 0 0 2px);
}
.dammy-text {
	margin-right: 5px;
	height: 25px;
	width: 19.750em;
}
</style>
<div class="title">
	<h2>Create Template</h2>
	<p><?php echo $this->Session->flash('template'); ?></p>
</div>
<div class="field">
	<?php echo $this->Form->create('Template', array('type' => 'post', 'class'=>'form-template')); ?>
	<div id="new-template" class="row">
		<div class="col-md-12">
			<h4>Template Name</h4>
			<input type="text" name="data[Template][name]" id="template" class="template-name" value="<?php echo h($template['Template']['name']); ?>" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div id="image" disabled="disabled"><div style='margin:5px'>image</div></div>
		</div>
		<div class="col-md-8">
			<input value="title" class="product-title" disabled>
			<textarea class="textarea" rows='10' disabled="disabled">outline</textarea>
		</div>
	</div>
	<div>
		<div class="col-md-12">
			<fieldset id="add-attributes">
				<h4>Attribute Name</h4>
				<input type="button" value="add" id="attribute" class="btn-add-attribute">
				<input type="button" id="btn-delete" class="button" value="all delete" />
				</br>
				<div id="input-attribute">
					<?php foreach($template['Attribute'] as $attribute): ?>
						<div id="<?php echo h($attribute['id']); ?>" class="div-attr">
							<input type="text" id="<?php echo h($attribute['id']); ?>" value="<?php echo h($attribute['name']); ?>" class="attribute attr-input" name="data[Attribute][name][]">
							<input type="text" id="<?php echo h($attribute['id']); ?>" class="dammy-text attr-input" disabled>
							<input type="button" value="×" id="<?php echo h($attribute['id']); ?>" class="btn-delete-attribute attribute">
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
		</div> <!-- col-md-12 -->
	</div> <!-- row -->
	
  	<?php echo $this->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-a btn-register')); ?>	
	<?php echo $this->Form->end(); ?>	
</div>
<div class="link">
	<h2>Link</h2>
	<a href="/templates/index" class="btn-b">テンプレート一覧</a>
	<a href="/products/index" class="btn-b">作品一覧</a>
</div>
<script>
$(function(){
	//アトリビュートフォーム自動生成
	// add
	$(document).on('click', '.btn-add-attribute', function(){
		var attrCnt = 1;
		while($('#attribute' + attrCnt).size() > 0){
			attrCnt++;
		}
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="div-attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="attribute attr-input" name="data[Attribute][name][]">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="dammy-text attr-input" disabled>\n');
		$('#attribute' + attrCnt).append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-delete-attribute attribute">\n');
	});
	// when push x button
	$(document).on('click', '.btn-delete-attribute', function(){
		attrID = $(this).attr('id');
		$("div#" + attrID).remove();
	});
	// delete all attribute
	$('#btn-delete').click(function() {
		if ($('#input-attribute input:text').length > 1) {
			$('.div-attr').remove();
		}
	});
});
</script>
