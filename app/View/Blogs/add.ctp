<?php
	echo $this->Html->css('blog_view');
	echo $this->Html->css('elrte/elfinder');
	echo $this->Html->css('elrte/elrte.full');
	echo $this->Html->css('elrte/ui-themes/base/ui.all');
	
	echo $this->Html->script('elrte/elfinder.min');
	echo $this->Html->script('elrte/elrte.full');
	echo $this->Html->script('elrte/jquery-ui-1.10.2.custom.min');
	echo $this->Html->script('elrte/elrte.full');
	
?>
<script type="text/javascript" charset="utf-8">  
$().ready(function() {  
　　　　var opts = {  
　　　　　　　　cssClass : 'el-rte',  
　　　　　　　　toolbar  : 'complete',  
　　　　　　　　cssfiles : ['elrte/elrte-inner.css'],  
　　　　　　　　fmOpen : function(callback) {  
　　　　　　　　　　　　$('<div id="myelfinder" />').elfinder({  
　　　　　　　　　　　　url : '<a href="http://bridge.com/connectors/php/connector.php" target="_blank" rel="noreferrer" style="cursor:help;display:inline !important;">http://bridge.com/connectors/php/connector.php</a>', //※  
　　　　　　　　　　　　lang : 'en',  
　　　　　　　　　　　　dialog : { width : 900, modal : true, title : 'Files' },  
　　　　　　　　　　　　closeOnEditorCallback : true,  
　　　　　　　　　　　　editorCallback : callback  
　　　　　　　　})  
　　　　}  
}  
$('#editor').elrte(opts);  
})  
</script>  
<body>
	<div id="container">
		<div id="elrte">
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
		</div>
    </div><!-- /.container -->
</body>