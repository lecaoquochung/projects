 <div>
    <?php echo $this->Html->link(__('Download Csv'), array('action' => 'csv_download'), array('class' => "btn btn-success")); ?>
    <?php echo $this->Html->link(__('Upload Csv'), array('action' => 'csv_upload'), array('class' => "btn btn-success")); ?>
 </div>
<div class="recruitsFixes ">
	<h2><?php echo __('Recruits Fixes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<!-- <th><?php echo $this->Paginator->sort('intro_title'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('intro_detail'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('office_name'); ?></th> -->
			<!-- <th><?php echo $this->Paginator->sort('office_name_kana'); ?></th> -->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($recruitsFixes as $recruitsFix): ?>
	<tr id="<?php echo h($recruitsFix['RecruitsFix']['id']); ?>">
		<td><?php echo h($recruitsFix['RecruitsFix']['id']); ?></td>
		<td class="edit_inline" name="name" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['name']); ?></td>
		<td class="edit_inline" name="title" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['title']); ?></td>
		<td class="edit_inline" name="description" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['description']); ?></td>
		<!-- <td class="edit_inline" name="intro_title" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['intro_title']); ?></td> -->
		<!-- <td class="edit_inline" name="intro_detail" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['intro_detail']); ?></td> -->
		<!-- <td class="edit_inline" name="office_name" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['office_name']); ?></td> -->
		<!-- <td class="edit_inline" name="office_name_kana" style="position:relative"><?php echo h($recruitsFix['RecruitsFix']['office_name_kana']); ?></td> -->
		<td class="actions">
			<?php #echo $this->Html->link(__('View'), array('action' => 'view', $recruitsFix['RecruitsFix']['id'])); ?>
			<?php #echo $this->Html->link(__('Edit'), array('action' => 'edit', $recruitsFix['RecruitsFix']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $recruitsFix['RecruitsFix']['id']), null, __('Are you sure you want to delete # %s?', $recruitsFix['RecruitsFix']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<!-- <div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div> -->
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<!-- <li><?php echo $this->Html->link(__('New Recruits Fix'), array('action' => 'add')); ?></li> -->
	</ul>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.edit_inline').click(function(){
			if($(this).find('#edit_inline').size()==0){
				$(this).html('<textarea id="edit_inline" style="width:100%;height:100%">'+$(this).html()+'</textarea>');			
				$(this).find('#edit_inline').focus().blur(function(){					
					var obj = $(this);
					obj.parents('td').append('<img src="<?php echo $this->webroot ?>img/loading.gif" alt="" style="position: absolute;" />');
					$.ajax({
						url: "<?php echo $this->webroot ?>RecruitsFixes/edit_ajax",
						data:{field:obj.parents('td').attr('name'),value:obj.html(),id:obj.parents('tr').attr('id')},
						type: 'post',
						success: function(data){
							obj.parents('td').html(obj.val());							
						}
					});
				})				;				
			}
		})		
	})
</script>