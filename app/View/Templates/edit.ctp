<?php
		$this->extend('/Common/index');

		echo $this->Html->css('templates');
		
?>

<script>
$(function(){
	//アトリビュートフォーム自動生成
	// add
	$(document).on('click', '.btn-add-attribute', function(){
		var attrCnt = 1;
		while($('#attribute' + attrCnt).size() > 0){
			attrCnt++;
		}
		$("#input-attribute").append('<div id="attribute' + attrCnt + '" class="attr">\n');
		$('#attribute' + attrCnt).append('<input type="text" id="attribute' + attrCnt +'" class="form-control" name="data[Attribute][name][]">');
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
			$('.attr').remove();
		}
	});
});
</script>



<div id="div-edit-templates" class="form second-content-form">
<?php echo $this->Form->create('Template', array('type' => 'post', 'class'=>'form-template')); ?>

	<div class="form-header">
		<div class="header-left">
			<a href="/products/index" class="header-link">View</a>
		</div>
		<div class="header-right">
			<input type="text" name="data[Template][name]" id="template" class="form-control page-title" value="<?php echo h($template['Template']['name']); ?>" />
		</div>
		<div class="div-decoration">
			<span>Templates</span>
		</div>
		
	</div>

	<div class="form-body">

		<div class="div-button">
			<button type="button" id="attribute" class="btn-add-attribute btn-blue add"><i class="fa fa-plus-circle"></i> add</button>
			<button type="button" id="btn-delete" class="button btn-danger del"><i class="fa fa-trash-o"></i> delete all</button>
		</div>
		<div class="cont3">
			<fieldset id="add-attributes">
				<div id="input-attribute">
					<div class="attr">
						<input class="form-control default" id="disabledInput" type="text" placeholder="タイトル" disabled>
					</div>
					<div class="attr">
						<input class="form-control default" id="disabledInput" type="text" placeholder="あらすじ" disabled>
					</div>
					<?php foreach($template['Attribute'] as $attribute): ?>
						<div id="<?php echo h($attribute['id']); ?>" class="attr">
							<input type="text" id="<?php echo h($attribute['id']); ?>" value="<?php echo h($attribute['name']); ?>" class="form-control" name="data[Attribute][name][]">
							<input type="button" value="×" id="<?php echo h($attribute['id']); ?>" class="btn-delete-attribute attribute">
						</div>
					<?php endforeach; ?>
				</div>
			</fieldset>
		</div> 
		

	</div> <!-- form-body -->

	<div class="form-footer">
		<div class="div-submit">
		  	<?php echo $this->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-blue btn-register')); ?>	
		</div>
	</div>

<?php echo $this->Form->end(); ?>	
</div> <!-- form -->
