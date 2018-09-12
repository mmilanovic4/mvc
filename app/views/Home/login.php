<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?php echo $DATA['message']; ?></p>
	<?php endif; ?>

	<form method="POST">
		<label>
			<span>Email:</span>
			<input type="email" name="email" required>
		</label>
		<label>
			<span>Password:</span>
			<input type="password" name="password" required>
		</label>
		<button type="submit">Log In</button>
	</form>
</main>
