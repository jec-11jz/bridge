<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<div>
	<select name="template" class="template-name" id="selected-template">
		<option value="" disabled>--選択してください--</option>
		<?php foreach($templates as $template) : ?>
			<?php if(isset($template['Template']['id'])){ ?>
				<?php if($template['Template']['id'] == $template_id) { ?>
					<option value="<?php echo $template['Template']['id']; ?>" selected><?php echo $template['Template']['name']; ?></option>
				<?php } else { ?>
					<option value="<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></option>
				<?php } ?>
			<?php } ?>
		<?php endforeach; ?>
		<option value="other">テンプレート作成</option>
	</select>
</div>
<script>
	$(function(){
		//テンプレートが選択されたら編集画面に飛ばす
		$("#selected-template").change(function() {
			var temp_id = $('#selected-template').val();
			console.log(temp_id);
			if(temp_id == 'other'){
				location.href="/templates/add";
				return;
			}// End if()
		});// End change()
	})
</script>

