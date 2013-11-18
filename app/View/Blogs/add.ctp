<?php
	echo $this->Html->css('blog_view');
	echo $this->Html->css('latest/themes/default.min');
	echo $this->Html->css('btn_custom');
	
	echo $this->Html->script('latest/jquery.sceditor.bbcode.min');
	
?>
<script>
$(function() {
	$("textarea").sceditor({
		plugins: "bbcode",
		style: "latest/jquery.sceditor.default.min.css"
	});
});
$('#editor').elrte(opts);
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
					?>
					<?php echo $this -> Form -> submit('保存', array('type' => 'submit', 'class' => 'btn-custom btn-sign')); ?>
					<?php echo $this->Form->end();?>
				</div>				
			</div>
		</div>
    </div><!-- /.container -->
</body>