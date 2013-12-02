<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Bridge | <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		
		echo $this->Html->css('bootstrap-glyphicons');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-bridge-theme.css');
		echo $this->fetch('css');
	
		echo $this->Html->script('jquery-1.10.2.min');
		echo $this->Html->script('jquery.ajaxFrom');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('jquery-validation/dist/jquery.validate.min');
		echo $this->Html->script('jquery-validation/dist/additional-methods.min');
		echo $this->Html->script('jquery-validation/localization/messages_ja');
		echo $this->fetch('script');
	?>
	<script>
		/* for Style */
		$('.dropdown-toggle').dropdown();
		$('#loginModal').modal();
		$('#signModal').modal();
		
		$( function() {
			
			$( '#cd-dropdown' ).dropdown();
			
			/* jquery.validate.js for Bootstrap3 */
			$.validator.setDefaults({
				highlight: function(element) {
					$(element).closest('.form-group').addClass('has-error');
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass('has-error');
				},
				errorElement: 'span',
				errorClass: 'help-block',
				errorPlacement: function(error, element) {
					if(element.parent('.input-group').length) {
						error.insertAfter(element.parent());
					} else {
						error.insertAfter(element);
					}
				}
			});
		});
	</script>

</head>
<body>
	<?php echo $this->fetch('content'); ?>
	<script>
		// this is important for IEs
		var polyfilter_scriptpath = '/js/';
	</script>
</body>
</html>