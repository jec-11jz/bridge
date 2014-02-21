<?php
		$this->extend('/Common/index');

		$this->Html->css('templates', null, array('inline' => false));
		$this->Html->css('mypage', null, array('inline' => false));
		
?>

<script>
    $(function(){
        $("#temp-list dt").on("click", function() {
            $(this).next().slideToggle();
        });
    });
    $(function () {
	  $('span').click(function() {
	    $(this).next('ul').slideToggle('fast');
	  });
	});

</script>


<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($user_info['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		<div class="header-user">
			<span><?php echo h($user_info['User']['name']); ?></span>
		</div>
		<div class="header-buttons">
			<div class="links-div div-fav">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav blogs</span>
				</div>
			</div>
		
			<div class="links-div div-products">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav products</span>
				</div>
			</div>
		
			
			<div class="links-div div-blogs">
				<a class="div-link" href="/blogs/index"></a>
				<div class="div-left">
					<i class="fa fa-book"></i>
				</div>
				<div class="div-right">
					<span>My blogs</span>
				</div>
			</div>
		
			<div class="links-div div-temp div-checked">
				<a class="div-link" href="/templates/index"></a>
				<div class="div-left">
					<i class="fa fa-th-list"></i>
				</div>
				<div class="div-right">
					<span>Template</span>
				</div>
			</div>
		
			<div class="links-div div-image">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>

			<div class="links-div div-edit">
				<a class="div-link" href=""></a>
				<div class="div-left">
					<i class="fa fa-cog"></i>
				</div>
				<div class="div-right">
					<span>My Edit</span>
				</div>
			</div>
		</div>
	</div><!-- form-header -->


	<div class="form-body">
		<a href="/templates/add" class="btn-blue">create</a>
		<div class="body-template">
		<?php foreach($templates as $template) : ?>
			<div class="template-contents">
				<span><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o delete')); ?></span>
				<a href="/templates/edit/<?php echo $template['Template']['id']; ?>" class="edit"><i class="fa fa-pencil-square-o"></i></a>

				<span class="contents-title"><?php echo $template['Template']['name']; ?></span>
				<ul class="contents-list">
				<?php foreach($template['Attribute'] as $attribute) : ?>
					<li class="contents-item">
					<?php if(isset($attribute['name'])){ ?>
						<?php echo $attribute['name']; ?>
					<?php } ?>
					</li>
				<?php endforeach; ?>
				</ul>
			</div> <!-- cont -->
		<?php endforeach; ?>
		</div>
	</div> <!-- form-body -->

	<div class="form-footer"></div>
</div> <!-- form -->




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
		



