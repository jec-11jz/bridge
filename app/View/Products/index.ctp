<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
	
	$this->extend('/Common/index');
?>
<div>
	<form type="post" action="/products/add">
		<input type="radio" name="template" id="movie" value="movie">
		<label for="movie">映画</label>
		<input type="radio" name="template" id="novel" value="novel">
		<label for="novel">小説</label>
		<input type="radio" name="template" id="anime" value="anime">
		<label for="anime">アニメ</label>
		<input type="radio" name="template" id="other" value="other">
		<label for="other">その他</label>
		<input type="submit" value="作成">
	</form>	
</div>


