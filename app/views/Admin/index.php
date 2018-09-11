<?php require_once './app/views/_global/header.php'; ?>

<header>
	<h1><?php echo $DATA['title']; ?></h1>
</header>

<main>
	<p>Welcome, <?php echo $DATA['user']; ?>!</p>

	<p>
		<a href="<?php Utils::generateLink('tasks'); ?>">Tasks</a>
		<br>
		<a href="<?php Utils::generateLink('logout'); ?>">Log Out</a>
	</p>
</main>

<?php require_once './app/views/_global/footer.php'; ?>
