<main>
	<?php if (count($DATA['tasks']) === 0): ?>
	<p>Tasklist is currently empty.</p>
	<?php else: ?>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Author</th>
					<th>Created at</th>
					<th colspan="2"></th>
			</thead>
			<tbody>
				<?php foreach ($DATA['tasks'] as $task): ?>
				<tr>
					<td><?php echo Security::escape($task->id); ?></td>
					<td><?php echo Security::escape($task->name); ?></td>
					<td><?php echo Security::escape($task->description); ?></td>
					<td><?php echo Security::escape($task->author); ?></td>
					<td><?php echo Security::escape($task->created_at); ?></td>
					<td>
						<a href="<?php Utils::generateLink('tasks/update/' . $task->id) ?>">
							Update
						</a>
					</td>
					<td>
						<a onclick="return confirm('Are you sure?');" href="<?php Utils::generateLink('tasks/delete/' . $task->id) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php endif; ?>

	<p>
		<a href="<?php Utils::generateLink('tasks/create'); ?>">Add task</a>
	</p>
</main>
