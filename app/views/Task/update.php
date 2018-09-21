<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?php echo $DATA['message']; ?></p>
	<?php endif; ?>

	<?php if (!$DATA['task']): ?>
	<p>/</p>
	<?php else: ?>
	<form method="POST">
		<input type="hidden" name="id" value="<?php echo Security::escape($DATA['task']->id); ?>">
		<label>
			<span>Name:</span>
			<input type="text" name="name" value="<?php echo Security::escape($DATA['task']->name); ?>" required>
		</label>
		<label>
			<span>Description:</span>
			<textarea name="description" required><?php echo Security::escape($DATA['task']->description); ?></textarea>
		</label>
		<button type="submit">Update</button>
	</form>
	<?php endif; ?>
</main>
