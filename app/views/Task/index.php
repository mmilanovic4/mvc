<main>
	<?php if (empty($DATA['tasks'])): ?>
	<p>Tasklist is currently empty.</p>
	<?php else: ?>
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>User</th>
					<th>Created at</th>
					<th colspan="2"></th>
			</thead>
			<tbody>
				<?php foreach ($DATA['tasks'] as $task): ?>
				<tr>
					<td><?= Security::escape($task->id); ?></td>
					<td><?= Security::escape($task->name); ?></td>
					<td><?= Security::escape($task->description); ?></td>
					<td><?= Security::escape($task->user); ?></td>
					<td><?= Security::escape($task->created_at); ?></td>
					<td>
						<a href="<?= Utils::generateLink('tasks/update/' . $task->id) ?>">
							Update
						</a>
					</td>
					<td>
						<a onclick="return confirm('Are you sure?');" href="<?= Utils::generateLink('tasks/delete/' . $task->id) ?>">
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
		<a href="<?= Utils::generateLink('tasks/create'); ?>">Add task</a>
	</p>
</main>
