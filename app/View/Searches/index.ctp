<?php
?>
	
<body>
	<div id="head-all"></div>
	<div id="container">
		<div class="contents">
			<div id="search">
				<h1>検索</h1>
				 <?php
					 echo $this->Form->create('Search', array('type' => 'post', 'action'=>'index'));
					 echo $this->Form->input('condition');
					 echo $this->Form->end('検索');
				 ?>
				 <hr size="5" />
				<table class="table table-hover">
					<tr>
						<?php foreach($blogs as $blog) : ?>
							<tr>
								<td>title : <?php echo $blog['Blog']['title']; ?></td>
							</tr>
							<td width="200px" height="auto">
							<?php if(isset($blog['UsedBlogImage'][0]['url'])) { ?>
								<img src="<?php echo $blog['UsedBlogImage'][0]['url']; ?>" width="200px" height="auto">
							<?php } else { ?>
								<div>****画像なし****</div>
							<?php
								$len = 100;
								print(mb_strimwidth($blog['Blog']['content'], 0, $len, "...", "UTF-8") . "<br />");
							?>
						<?php } ?>
						</td>
						<hr />
					</tr>
				</table>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div id="foot-all"></div>
</body>
	
	 
