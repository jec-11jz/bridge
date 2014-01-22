<?php
		echo $this->Html->css('diary');
		echo $this->Html->css('templates');
		
		$this->extend('/Common/index');
?>
<script>
$(function(){
	//アトリビュートフォーム自動生成
	for(attrCnt = 0; attrCnt < 3; attrCnt++) {
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="form-control attribute attr-input" name="data[Attribute][name][]">');
		$('#attribute' + attrCnt).append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-delete-attribute attribute">\n');
	}
	//追加処理
	$(document).on('click', '.btn-add-attribute', function(){
		var attrCnt = 1;
		while($('#attribute' + attrCnt).size() > 0){
			attrCnt++;
		}
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="form-control attribute attr-input" name="data[Attribute][name][]">');
		$('#attribute' + attrCnt).append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-delete-attribute attribute">\n');
	});
	//削除処理
	$(document).on('click', '.btn-delete-attribute', function(){
		attrID = $(this).attr('id');
		$("div#" + attrID).remove();
	});
	// delete all attribute
	$('#btn-delete').click(function() {
		if ($('#input-attribute input:text').length > 1) {
			$('.attr').remove();
		}
	});
});
</script>

<div class="form first-content-form">

	<div class="form-headder">
		<h1>Create Template</h1>
		<p><?php echo $this->Session->flash('template'); ?></p>
	</div>

	<div id="template-edit">
		<?php echo $this->Form->create('Template', array('type' => 'post', 'action' => 'add', 'class'=>'form-template')); ?>
		<div class="cont1">
			<h4>Template Name</h4>
			<input type="text" name="data[Template][name]" id="template" class="form-control title" value="" />
		</div>
		<div class="cont2">
			<input type="button" value="add" id="attribute" class="btn-add-attribute btn-blue add">
			<input type="button" id="btn-delete" class="button btn-danger del" value="all delete" />
		</div>
		<div class="cont3">
			<fieldset id="add-attributes">
				<div id="input-attribute"></div>
			</fieldset>
		</div> <!-- row -->
  		<?php echo $this->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-a btn-register')); ?>	
		<?php echo $this->Form->end(); ?>	

	</div><!-- field -->
</div> <!-- form -->
