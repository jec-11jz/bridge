<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');	
?>
<legend>Link</legend>
<a href="/templates/index" class="btn-a">一覧へ戻る</a>
<a href="/products/index" class="btn-a">作品一覧</a>
<legend>Create Template</legend>
<p><?php echo $this->Session->flash('template'); ?></p>
<div>
	<?php echo $this->Form->create('Template', array('type' => 'post', 'action' => 'add')); ?>
	<legend>テンプレート</legend>
	<select name="template" class="template-name" id="selected-template">
		<option value="" disabled>--選択してください--</option>
		<?php foreach($templates as $template) : ?>
			<?php if(isset($template['Template']['id'])){ ?>
				<option value="<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></option>
			<?php } ?>
		<?php endforeach; ?>
		<option value="other" selected>その他</option>
	</select>
	<div id="new-template">
		<input type="text" name="data[Template][name]" id="template" value="" />
	</div>
	<fieldset id="add-attributes">
		<legend>項目</legend>
		<input value="作品タイトル" disabled>
		<input name="data[Attribute][name][]" class="input" type="text" id="attribute" class="attribute">
		<input type="button" value="×" id="attribute" class="btn-attribute">
	</fieldset>
	<hr size="3" />
	<fieldset id="attributes-button">
	    <input type="button" id="btn-insert" value="一行追加" />
	    <input type="button" id="btn-delete" value="全削除" />
  	</fieldset>
  	<?php echo $this->Form->submit('登録', array('type' => 'submit', 'class' => 'btn-a')); ?>	
	<?php echo $this->Form->end(); ?>	
</div>

<script>
//新しいテンプレート名を入力するテキストボックス作成
function createInputText(oName, oId, oValue, oSize) {
	var newTextBox = document.createElement("input");
	newTextBox.type = "text";
	newTextBox.name = oName;
	newTextBox.id = oId;
	newTextBox.value = oValue;
	newTextBox.size = oSize;
	$('#new-template').append(newTextBox);
}
$(function(){	
	$(".template-name").change(function() {
		$('#template').remove();
		$(this).find('option:selected').each(function() {
			if ($(this).val() == 'other') {
				createInputText('data[Template][name]', 'template', '', 30);
			}// End if()
		}); // End each()
	}); // End change()
	
	//テンプレートが選択されたらアトリビュートを呼び出す
	$("#selected-template").change(function() {
		var temp_id = $('#selected-template').val();
		console.log(temp_id);
		if(temp_id == 'other'){
			return;
		} else {
			console.log('success');
			location.href="/templates/edit/" + temp_id;
		}// End if()
	});// End change()
	
	//アトリビュートフォーム自動生成
	//追加処理
	$("#btn-insert").click(function() {
		var attrCnt = $('#add-attributes input:text').length + 1
		$("#add-attributes").append('<input type=\"text\" name=\"data[Attribute][name][]\" id="attribute' + attrCnt +'"　class="attribute" value=\"\">\n');
		$("#add-attributes").append('<input type="button" value="×" id="attribute' + attrCnt +'" class="btn-attribute"> \n');
	});
	//削除処理
	$(document).on('click', '.btn-attribute', function(){
		attrID = $(this).attr('id');
		console.log(attrID);
		$("#" + attrID).remove();
		$("#" + attrID).remove();
		
		
	});
	
	$('#btn-delete').click(function() {
		if ($('#add-attributes input:text').length > 1) {
			$('#add-attributes').find("input").remove();
		}
	});
});
</script>