<?php
		echo $this->Html->css('diary');
		echo $this->Html->css('templates');
		
		$this->extend('/Common/index');
		echo $this->Html->script('jquery.hcaptions');
?>

<script>
    $(function(){
        $("#temp-list dt").on("click", function() {
            $(this).next().slideToggle();
        });
    });

    $(function () {
	  // 親メニュー処理
	  $('span').click(function() {
	    // メニュー表示/非表示
	    $(this).next('ul').slideToggle('fast');
	  });

	  // 子メニュー処理
	  $('li').click(function(e) {
	    // メニュー表示/非表示
	    $(this).children('ul').slideToggle('fast');
	    e.stopPropagation();
	  });
	});
</script>


<div class="form first-content-form">
	<div class="form-headder">
		<h1>My Templates and My Attributes</h1>
	</div>
	<div class="box-flex">
		<div class="button-full"><a href="/templates/index" class="btn-b left">View Templates</a></div>
		<div class="button-full"><a href="/products/index" class="btn-b">View Products</a></div>
		<div class="button-full"><a href="/templates/add" class="btn-b right">Create Templates</a></div>
	</div>

	<!-- テンプレート一覧 -->
	<div id="template-index" class="contents">
		<?php foreach($templates as $template) : ?>
			<div class="cont">

				<span><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></span>
				<a href="/templates/edit/<?php echo $template['Template']['id']; ?>" class="edit">edit</a>
				<span class="title"><?php echo $template['Template']['name']; ?></span>
				<ul>
				  <?php foreach($template['Attribute'] as $attribute) : ?>
					<li>
					<?php if(isset($attribute['name'])){ ?>
						<?php echo $attribute['name']; ?>
					<?php } ?>
					</li>
				  <?php endforeach; ?>
				</ul>
			</div> <!-- cont -->
		<?php endforeach; ?>
	</div>

</div> <!-- form -->

