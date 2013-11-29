<!-- add.ctpを呼び出すので不要 -->
<?php
	echo $this->Html->css('tag/tags');
	echo $this->Html->css('diary');
	
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('tag/tags');
?>
<!-- JS tag -->
<script type="text/javascript">
	$(function() {
	  $('#tags').tagbox({
	    url : ["api","blog","bootstrap","carousel","comments","configuration","content","css","database","date",
	    	"drafts","email","experiment","fancybox","flickr","forum","google","html5","images","installation","jquery","js",
	    	"json","kirbytext","language","maps","markdown","masonry","metatags","pagination","panel","plugin","releases","rss","search",
	    	"security","server","tags","thumbnails","toolkit","tutorial","twitter","typography","uri","use case","videos","yaml"], 
	    lowercase : true
	  });
	});
</script>
<div class='form'>
	<input type="text" id="tags" name="tags" />		
	<?php echo $this->Form->create('Blog'); ?>
	<?php echo $this->Form->input('title', array(
			'label'=>'タイトル', 
			'type'=>'text',
			'class'=>'input_form',
			'error' => array(
				'isUnique' => __('そのユーザーIDは既に使われています', true),
				'custom' => __('半角英数字のみ使用できます', true),
				'minLength' => __('15文字以内で入力してください', true)))); 
	 
		// バリデーションのエラーメッセージを指定
		echo $this->Form->input('content', array(
			'label'=>'本文', 
			'type'=>'textarea',
			'id'=>'ckeditor',
			'class'=>'input_form blog',
			'error' => array(
				'isUnique' => __('そのユーザーIDは既に使われています', true),
				'custom' => __('半角英数字のみ使用できます', true),
				'minLength' => __('15文字以内で入力してください', true)))); 
	?>
	<!-- JS wysiwyg -->
	<script type="text/javascript">  
		var editor = CKEDITOR.replace('ckeditor');  
	</script>  
	<?php echo $this->Form->end('保存');?>			
</div> <!-- div form -->
