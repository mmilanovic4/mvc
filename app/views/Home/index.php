<main>
	<?php if (!$DATA['user']): ?>
	<p>Not logged in.</p>
	<?php else: ?>
	<p>Welcome, <?php echo $DATA['user']; ?>!</p>
	<?php endif; ?>
</main>
