<div class="images form">
<?php echo $this->Form->create('Image', array('action' => 'add', 'type' => 'file')); ?><fieldset>
<legend><?php echo __('Add Image'); ?></legend>
<?php echo $this->Form->file('image'); ?>
</fieldset>
<?php echo $this->Form->end(__('画像を追加'));?>
</div>

 
 
<div class="uploads index">
<h2><?php echo __('Images'); ?></h2>
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<th><?php echo __('id'); ?></th>
<th><?php echo __('name'); ?></th>
<th><?php echo __('contents'); ?></th>
</tr>
 
<?php foreach ($images as $image) : ?>
<tr>
<td><?php echo h($image['Image']['id']); ?></td>
<td><?php echo h($image['Image']['name']); ?></td>
<td><?php echo $this -> Html->link(__("/images/contents/{$image['Image']['name']}"), array('action' => "/contents/{$image['Image']['name']}" ), array ( 'target' => '_blank' ) ); ?></td>
</tr>
<?php endforeach; ?>
</tbody></table>
</div>