<?php require_once './app/views/_global/header.php'; ?>

<header>
	<h1><?php echo $DATA['title']; ?></h1>
</header>

<main>
	<?php if (isset($DATA['message'])): ?>
	<p><?php echo $DATA['message']; ?></p>
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

<?php require_once './app/views/_global/footer.php'; ?>
