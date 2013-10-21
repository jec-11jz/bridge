<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<a href="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" target="_blank" rel="noreferrer" style="cursor:help;display:inline !important;">http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd</a>">  
<html xmlns="<a href="http://www.w3.org/1999/xhtml" target="_blank" rel="noreferrer" style="cursor:help;display:inline !important;">http://www.w3.org/1999/xhtml</a>">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
<title>elRTE</title>  
  
<!-- jQuery and jQuery UI 読み込み -->  
<script src="js/jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>  
<script src="js/jquery-ui-1.7.2.custom.min.js" type="text/javascript" charset="utf-8"></script>  
<link rel="stylesheet" href="js/ui-themes/base/ui.all.css" type="text/css" media="screen" charset="utf-8">  
  
<!-- elRTE javascript読み込み -->  
<script src="js/elrte.full.js" type="text/javascript" charset="utf-8"></script>  
  
<!-- elRTEスタイルシート読み込み -->  
<link rel="stylesheet" href="css/elrte.full.css" type="text/css" media="screen" title="elRTE" charset="utf-8">  
  
<script type="text/javascript" charset="utf-8">  
$().ready(function() {  
    var opts = {  
        height   : 450, // エディタ領域の高さを変更できます。  
        toolbar  : 'complete', // ツールバーの内容を変更できます。※1  
    }  
    $('#editor').elrte(opts);　// id="editor"の要素に反映されます。  
})  
</script>  
  
<body>  
<div id="editor">  
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
			<hr/>
			<div id="elrte">
				<div class="el-rte ui-resizable">
					<div class="toolbar"></div>
				</div>
				
			</div>
			</div>
		</div>
    </div><!-- /.container -->  
</div>  
</body>  
</html>  