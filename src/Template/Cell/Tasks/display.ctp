<table class="table table-striped">
<tr class="danger">
	<th>
		<?= __('ID') ?>	
	</th>
	<th width="10%">
		<?= __('Redmine id') ?>						
	</th>
	<th width="20%">
		<?= __('Assigned') ?>						
	</th>
	<th width="30%">
		<?= __('Title') ?>						
	</th>
	<th>
		<?= __('Reviewer') ?>						
	</th>
	<th>
		<?= __('Project') ?>						
	</th>
	<th>
		<?= __('Modified') ?>						
	</th>
</tr>
<?php
	foreach ($tasks as $task){
	?>
	<tr>
		<td>
			<?= $task['id'] ?>	
		</td>
		<td>
			<?= $task['redmine_id'] ?>					
		</td>
		<td>
			<?= $task['assigned'] ?>						
		</td>
		<td>
			<a href="#"><?= $task['title'] ?></a>				
		</td>
		<td>
			<?= $task['member_review'] ?>						
		</td>
		<td>
			<?= $task['project'] ?>						
		</td>
		<td>
			<?= $task['modified'] ?>						
		</td>	
	</tr>
	<?php
	}
?>
</table>