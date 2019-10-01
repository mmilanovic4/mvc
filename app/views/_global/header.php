<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= isset($DATA['title']) ? $DATA['title'] . ' | MVC' : 'MVC'; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
	<!-- CSS -->
	<link rel="stylesheet" href="<?= Utils::generateLink('assets/css/main.css'); ?>">
	<!-- Favicon -->
	<link rel="icon" href="<?= Utils::generateLink('assets/favicon.png'); ?>">
</head>

<body>

	<header>
		<?php if (isset($DATA['title'])): ?>
		<h1><?= Security::escape($DATA['title']); ?></h1>
		<?php endif;?>
	</header>

	<nav>
		<ul>
			<li><a href="<?= Utils::generateLink(''); ?>">Home</a></li>
			<li><a href="<?= Utils::generateLink('tasks'); ?>">Tasks</a></li>
			<?php if (empty(Session::get(Config::USER_COOKIE))): ?>
			<li><a href="<?= Utils::generateLink('login'); ?>">Log in</a></li>
			<?php else:?>
			<li><a onclick="return confirm('Are you sure?');" href="<?= Utils::generateLink('logout'); ?>">Log out</a></li>
			<?php endif; ?>
		</ul>
	</nav>
