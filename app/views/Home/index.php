<?php require_once './app/views/_global/header.php'; ?>

<header>
	<h1><?php echo $DATA['title']; ?></h1>
</header>

<main>
	<?php if ($DATA['user'] === false): ?>
	<p>
		<a href="<?php Utils::generateLink('login'); ?>">Log In</a>
	</p>
	<?php else: ?>
	<p>Welcome, <?php echo $DATA['user']; ?>!</p>
	<p>
		<a href="<?php Utils::generateLink('admin'); ?>">Admin Home</a>
		<br>
		<a href="<?php Utils::generateLink('logout'); ?>">Log Out</a>
	</p>
	<?php endif; ?>
</main>

<?php require_once './app/views/_global/footer.php'; ?>
