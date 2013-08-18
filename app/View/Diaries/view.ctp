<div class="diaries view">
<h2><?php echo __('Diary'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($diary['User']['mail_address'], array('controller' => 'users', 'action' => 'view', $diary['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thumbnail'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['thumbnail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['updated_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($diary['Diary']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Diary'), array('action' => 'edit', $diary['Diary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Diary'), array('action' => 'delete', $diary['Diary']['id']), null, __('Are you sure you want to delete # %s?', $diary['Diary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Diaries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Diary'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
