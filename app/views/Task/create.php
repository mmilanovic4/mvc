<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?= Security::escape($DATA['message']); ?></p>
	<?php endif; ?>

	<form method="POST">
		<label>
			<span>Name:</span>
			<input type="text" name="name" required>
		</label>
		<label>
			<span>Description:</span>
			<textarea name="description" required></textarea>
		</label>
		<button type="submit">Create</button>
	</form>
</main>
