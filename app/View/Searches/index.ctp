<?php
?>
<div id="search">
	<h1>検索</h1>
	 <?php
		 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
		 echo $this->Form->input('condition');
		 echo $this->Form->end('検索');
	 ?>
	<table class="table table-hover">
			<?php foreach($blogs as $blog) : ?>
			<tr>
				<td><a href="/blogs/view/<?php echo $blog['Blog']['id'] ?>"><?php echo $blog['Blog']['title']; ?>
				<!-- start show image -->
				<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
					<!-- 画像が使用されている場合 -->
					<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
				<?php } else { ?>
					<!-- 画像が使用されていない場合 -->
					<div>画像なし</div>
					<!-- 本文を１００文字表示する -->
					<?php
						$len = 100;
						print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
					?>
				<?php } ?>
				<!-- end show image -->
				</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div> <!-- END search -->
	
	 
