<?php
$this->Html->script(array("jquery.1.7.2.min"));
 
$this->Html->css(array("/lib/elfinder/css/elfinder.min"));
$this->Html->css(array("/lib/elfinder/css/theme"));
$this->Html->css(array("jquery-ui-1.8.22.custom"));
 
$this->Html->script(array("jquery-ui-1.8.22.custom"));
$this->Html->script(array("/lib/elfinder/js/elfinder.min"));
?>
<script>
$(document).ready(function(){   
       var f = $('#Elfinder').elfinder({
      url : 'http://the.url.to.this.page', 
      height: 600
    }).elfinder('instance');     
});
</script>
 
<div id="Elfinder">media bibliotek</div>