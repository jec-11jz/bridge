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
<script type="text/javascript">
function openKCFinder(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" name="data[User][users_image]" src="' + url + '" />';
                var img = document.getElementById('img');
                img.style.width = '100%';
                img.style.visibility = "visible";
            }
        }
    };
    window.open('/js/kcfinder/browse.php?type=images&dir=images/public',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>


<div class="form third-content-form">
	<div class="form-header">
		<div class="header-back" id="cover" style="background: url('<?php echo h($user_info['User']['cover_image']); ?>') no-repeat center ;" alt=""></div>
		<div class="header-user">
			<div class="user-potision">
				<div class="div-user-image">
					<a href="/users/mypage" class="link"></a>
					<img id="user-img" class="user-image" src="<?php echo h($user_info['User']['users_image']) ;?>" >
				</div>
				<div class="div-user-name">
					<span class="user-nickname"><?php echo h($user_info['User']['nickname']); ?></span>
					<span class="user-name">ID: <?php echo h($user_info['User']['name']); ?></span>
				</div>
			</div>
		</div><!-- header-user -->
		<div class="header-buttons">
			<div class="links-div div-fav">
				<a class="div-link" href="/users/mypage"></a>
				<div class="div-left">
					<i class="fa fa-star-o"></i>
				</div>
				<div class="div-right">
					<span>Fav blogs</span>
				</div>
			</div>
		
			<div class="links-div div-products">
				<a class="div-link" href="/users/mypage"></a>
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
				<a class="div-link" href="openKCFinder"></a>
				<div class="div-left">
					<i class="fa fa-picture-o"></i>
				</div>
				<div class="div-right">
					<span>Image upload</span>
				</div>
			</div>

			<div class="links-div div-edit">
				<a class="div-link" href="/users/edit"></a>
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


		



