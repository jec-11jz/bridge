<?php
	echo $this->element('menu', array('user', $user));
	echo $this->element('login_signup_modals');
?>
<div id="contents">
	<?php echo $this->fetch('content'); ?>
</div>

<footer id="footer">
	<p class="copyright">
		<small>&copy; Bridge</small>
	</p>
</footer>