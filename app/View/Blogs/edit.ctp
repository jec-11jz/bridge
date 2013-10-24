<?php
	echo $this->Html->css('blog_view');
	echo $this->Html->css('sce_editer/themes/default.min');
	echo $this->Html->script('sce_editer/jquery.sceditor.bbcode.min');
	
?>
<script>
	$(function() {
	$("textarea").sceditor({
		plugins: "bbcode",
		style: "<?php echo $this->Html->url("/js/sce_editer/jquery.sceditor.default.min.css"); ?>"
	});
});
</script>
<body>
	<div id="container">
		<div id="contents">
			<div class='form'>
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
						'class'=>'input_form blog',
						'error' => array(
							'isUnique' => __('そのユーザーIDは既に使われています', true),
							'custom' => __('半角英数字のみ使用できます', true),
							'minLength' => __('15文字以内で入力してください', true)))); 
				// 「保存」ボタンの配置
				echo $this->Form->end('保存');?>
			</div>
			</div>
		</div>
    </div><!-- /.container -->
</body>