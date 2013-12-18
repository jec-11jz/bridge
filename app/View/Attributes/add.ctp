<?php
		echo $this->Html->css('diary');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');	
?>

<div>
	<?php echo $this->Form ->create('Attribute', array('type' => 'post', 'action' => 'add')); ?>
	<legend>テンプレート</legend>
	<select name="data[Templete][name]" class="template-name">
		<option value="movie">映画</option>
		<option value="comic">漫画</option>
		<option value="other">その他</option>
	</select>
	<div id="new-template"></div>
	<fieldset id="add-attributes">
		<legend>項目</legend>
		<?php echo $this->Form ->input('name', array('label'=>false, 'type'=>'text', 'class'=>'input_form')); ?>
	</fieldset>
	<hr size="3" />
	<fieldset id="attributes-button">
	    <input type="button" onclick="addInput()" value="一行追加" />
	    <input type="button" onclick="delInput()" value="一行削除" />
  	</fieldset>
	<?php echo $this->Form->end('登録'); ?>	
</div>
<script>
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
			} 
		});
	});
});
var arInput = 1; //初期入力フォームの数
var Default = arInput;
function addInput() { //追加処理
　arInput++
　$("#add-attributes").append('<span id=\"attribute'+arInput+'\"><input type=\"text\" name=\"'+arInput+'\" value=\"" /></span>\n');
}
function delInput() { //削除処理
	$("#attribute"+arInput).remove();
　	if(arInput > Default){
　　		arInput --
　	}
}
</script>