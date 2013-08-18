<div class="diaries form">
<?php echo $this->Form->create('Diary'); ?>
	<fieldset>
		<legend><?php echo __('Edit Diary'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('thumbnail');
		echo $this->Form->input('created_at');
		echo $this->Form->input('updated_at');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Diary.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Diary.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Diaries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
