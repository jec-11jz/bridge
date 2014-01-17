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

<style>
	body {
		background: #FFFFFF;
	}
</style>

<legend>My Templates and My Attributes</legend>
<div id="template-index">
	<!-- テンプレート一覧 -->
	<h2>テンプレート一覧</h2>

	<?php foreach($templates as $template) : ?>
		<div class="cont">
			<?php if(isset($template['Template']['id'])){ ?>
				<!-- <dl id="temp-list">
				    <dt>テンプレタイトル：<a href="/templates/edit/<?php echo $template['Template']['id']; ?>"><?php echo $template['Template']['name']; ?></a></dt>
				    <?php foreach($template['Attribute'] as $attribute) : ?>
					    <li>
						    <?php if(isset($attribute['name'])){ ?>
							<?php echo $attribute['name']; ?>
							<?php } ?>
						</li>
					<?php endforeach; ?>
					<dd>aaa</dd>
				    <dt>ID:<?php echo $template['Template']['id']; ?></dt>
				    <dd>アコーディオンメニューが開く。</dd>
				</dl>
			
				<span><?php echo $this->Form->postLink("", array('action' => 'delete', $template['Template']['id']), array('confirm' => '削除しますか？', 'class'=>'fa fa-trash-o')); ?></span> -->
			<?php } ?>
			<!-- <a href="/templates/edit/<?php echo $template['Template']['id']; ?>"> -->
			<span><?php echo $template['Template']['name']; ?></span>
			<span><a href="/templates/edit/<?php echo $template['Template']['id']; ?>">edit</a></span>
			<ul>
				<li>メニュー 1-1
				  <ul>
				  <li>メニュー 1-1-1
				    <ul>
				    <li><a href="#">メニュー 1-1-1-1</a></li>
				    <li><a href="#">メニュー 1-1-1-2</a></li>
				    <li><a href="#">メニュー 1-1-1-3</a></li>
				    </ul>
				  </li>
				  <li>メニュー 1-1-2
				    <ul>
				    <li><a href="#">メニュー 1-1-2-1</a></li>
				    <li><a href="#">メニュー 1-1-2-2</a></li>
				    <li><a href="#">メニュー 1-1-2-2</a></li>
				    </ul>
				  </li>
				  </ul>
				</li>
			</ul>
		</div>
	<?php endforeach; ?>
	

	<!-- アトリビュート一覧 -->
	<h2>属性一覧</h2>
	<table class="table">
		<?php foreach($templates as $template) : ?>
			<?php if($template['Attribute'] != false) { ?>
				<th>【テンプレート名】<?php echo h($template['Template']['name'] . '：' . $template['Template']['id']); ?></th>
				<?php foreach($template['Attribute'] as $attribute) : ?>
					<tr>
					<?php if(isset($attribute['name'])){ ?>
						<td><?php echo $attribute['name']; ?></td>
					<?php } ?>
					</tr>
				<?php endforeach; ?>
			<?php } ?>
		<?php endforeach; ?>
	</table>
</div>
<div class="link">
	<h2>Link</h2>
	<a href="/templates/index" class="btn-b">テンプレート一覧</a>
	<a href="/products/index" class="btn-b">作品一覧</a>
	<a href="/templates/add" class="btn-b">テンプレート作成</a>
</div>
