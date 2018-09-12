<main>
	<?php if (count($DATA['tasks']) === 0): ?>
	<p>Tasklist is currently empty.</p>
	<?php else: ?>
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
				<td><?php echo $task->id; ?></td>
				<td><?php echo $task->name; ?></td>
				<td><?php echo $task->description; ?></td>
				<td><?php echo $task->author; ?></td>
				<td><?php echo $task->created_at; ?></td>
				<td>
					<a href="<?php Utils::generateLink('tasks/update/' . $task->id) ?>">
						Update
					</a>
				</td>
				<td>
					<a onclick="return confirm('Delete this item?');" href="<?php Utils::generateLink('tasks/delete/' . $task->id) ?>">
						Delete
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>

	<p>
		<a href="<?php Utils::generateLink('tasks/create'); ?>">Add task</a>
	</p>
</main>
