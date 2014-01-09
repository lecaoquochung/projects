<div class="recruitsFixes form">
<?php echo $this->Form->create('RecruitsFix', array('type'=>'file')); ?>
	<?php if(isset($import_errors) && count($import_errors)>0): ?>
	<div class="alert error_box">
		<?php echo implode('<br />', $import_errors); ?>
	</div>
	<?php endif ?>
	<fieldset>
		<legend><?php echo __('CSV Upload'); ?></legend>
	<?php
		echo $this->Form->input('csv',array('type' => 'file', 'label' => 'File CSV'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Recruits Fixes'), array('action' => 'index')); ?></li>
	</ul>
</div>

<div style="clear:both">
	<h2><?php echo __('Files CSV'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('File Name'); ?></th>
			<th><?php echo __('Create'); ?></th>
			<th><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($files as $file):?>
	<tr>
		<td><?php echo $file['Csv']['filename']; ?></td>
		<td><?php echo date("Y-m-d H:i:s", strtotime($file['Csv']['created'])); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete_csv', $file['Csv']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>