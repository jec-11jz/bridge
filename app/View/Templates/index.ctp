<?php
		$this->extend('/Common/index');


		echo $this->Html->css('templates');
		
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

	});

</script>


<div class="form first-content-form">
	<div class="form-headder">
		<h1>My Templates</h1>
	</div>
	<div class="box-flex">
		<div class="button-full"><a href="/templates/index" class="btn-black left">View Templates</a></div>
		<div class="button-full"><a href="/products/index" class="btn-black left">View Products</a></div>
		<div class="button-full"><a href="/products/add" class="btn-black">Create Products</a></div>
		<div class="button-full"><a href="/templates/add" class="btn-black right">Create Templates</a></div>
	</div>

	<!-- テンプレート一覧 -->
	<div id="template-index" class="contents">
		<?php foreach($templates as $template) : ?>
			<!-- <div class="caption"> -->
			<div class="cont contents">
				<span><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o delete')); ?></span>
				
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
				<a href="/templates/edit/<?php echo $template['Template']['id']; ?>" class="edit"><i class="fa fa-pencil-square-o"></i></a>
			</div> <!-- cont -->
			<!-- </div> -->
		<?php endforeach; ?>
	</div>
<!-- 
	<div id="nav-case" style="overflow: hidden;">
		<?php foreach($templates as $template) : ?>
			<div class="cont" style="display:inline-block;">
				<div id="sampleBtn" class="sampleBtn01" style="display:inline;"><a class="title"><?php echo $template['Template']['name']; ?></a></div>
				<span><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></span>
				<a href="/templates/edit/<?php echo $template['Template']['id']; ?>" class="edit">edit</a>
				<nav class="sample-list1" style="display: none; overflow:hidden;">
				  <?php foreach($template['Attribute'] as $attribute) : ?>
					<ul>
					<?php if(isset($attribute['name'])){ ?>
						<?php echo $attribute['name']; ?>
					<?php } ?>
					</ul>
				  <?php endforeach; ?>
				</nav>

			</div>
		<?php endforeach; ?>
	</div>  -->
		

</div> <!-- form -->

