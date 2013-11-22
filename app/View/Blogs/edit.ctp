<?php
<<<<<<< HEAD
	echo $this->Html->css('diary');
	echo $this->Html->css('sce_editer/themes/default.min');
	echo $this->Html->script('sce_editer/jquery.sceditor.bbcode.min');
=======
	echo $this->Html->css('blog_view');
	echo $this->Html->css('latest/themes/default.min');
	
	echo $this->Html->script('ckeditor/ckeditor');
>>>>>>> feature/importedFunctionLoginByTheJS
	
?>
<body>
	<div id="container">
		<div id="contents">
			<div class='form'>
			<input type="text" id="tags" name="tags" />
			<script type="text/javascript">
				$(function() {
				  $('#tags').tagbox({
				    url : ["api","blog","bootstrap","carousel","comments","configuration","content","css","database","date","drafts","email","experiment","fancybox","flickr","forum","google","html5","images","installation","jquery","js","json","kirbytext","language","maps","markdown","masonry","metatags","pagination","panel","plugin","releases","rss","search","security","server","tags","thumbnails","toolkit","tutorial","twitter","typography","uri","use case","videos","yaml"], 
				    lowercase : true
				  });
				});
			</script>
			<?php echo $this->Form->create('Blog'); ?>
				<div class="form-group">
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
					<script type="text/javascript">  
						var editor = CKEDITOR.replace('ckeditor');  
					</script>  
					<?php echo $this->Form->end('保存');?>
				</div>				
			</div>
		</div>
    </div><!-- /.container -->
</body>
