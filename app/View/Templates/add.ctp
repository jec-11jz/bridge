<?php
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

<div id="div-add-templates" class="form second-content-form">
<?php echo $this->Form->create('Template', array('type' => 'post', 'action' => 'add', 'class'=>'form-template')); ?>

	<div class="form-header">
		<div class="header-left">
			<a href="/products/index" class="header-link">Create</a>
		</div>
		<div class="header-right">
			<input type="text" name="data[Template][name]" id="template" class="form-control page-title" value="" placeholder="Title..." />
		</div>
		<div class="div-decoration">
			<span>Templates</span>
		</div>
		
	</div>

	<div class="form-body">
		
		<div class="div-button">
			<button type="button" id="attribute" class="btn-add-attribute btn-blue"><i class="fa fa-plus-circle"></i> add</button>
			<button type="button" id="btn-delete" class="button btn-danger del"><i class="fa fa-trash-o"></i> delete all</button>
		</div>
		<fieldset id="add-attributes">
			<div id="input-attribute">
				<div class="attr">
					<input class="form-control default" id="disabledInput" type="text" placeholder="タイトル" disabled>
				</div>
				<div class="attr">
					<input class="form-control default" id="disabledInput" type="text" placeholder="あらすじ" disabled>
				</div>
			</div>
		</fieldset>
  			

	</div><!-- field -->

	<div class="form-footer">
		<div class="div-submit">
			<?php echo $this->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-blue btn-register')); ?>
		</div>
	</div>
<?php echo $this->Form->end(); ?>	
</div> <!-- form -->
