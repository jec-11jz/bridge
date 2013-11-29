<?php
	echo $this->Html->css('tag/tags');
	
	echo $this->Html->script('tag/tags');
?>

<!-- JS tag -->
<script type="text/javascript">
	$(function() {
	  $('#tags').tagbox({
	    url : ["api","blog","bootstrap","carousel","comments","configuration","content","css","database",
		    "date","drafts","email","experiment","fancybox","flickr","forum","google","html5","images","installation","jquery","js","json","kirbytext",
		    "language","maps","markdown","masonry","metatags","pagination","panel","plugin","releases","rss","search","security","server","tags",
		    "thumbnails","toolkit","tutorial","twitter","typography","uri","use case","videos","yaml"], 
	    lowercase : true
	  });
	});
</script>
<div id="head-all"></div>
<div class="addTagForm">
	<input type="text" id="tags" name="tags" />
	<?php echo $this->Form->create('Tag', array('type' => 'post', 'action' => 'add')); ?>
	<?php echo $this -> Form -> submit('Save', array('type' => 'submit', 'class' => 'btn-a')); ?>
	<?php echo $this -> Form -> end(); ?>
</div>
<script>
    $('#TagAddForm').submit(function(){
    	$('.tagbox .tag').each(function(i, tag){
    		console.log(tag.innerHTML);
    	});
    	
    	return false;
    });
</script>