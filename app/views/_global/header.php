<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo isset($DATA['title']) ? $DATA['title'] . ' | MVC' : 'MVC'; ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSS -->
	<link rel="stylesheet" href="<?php Utils::generateLink('assets/css/main.css'); ?>">
	<!-- Favicon -->
	<link rel="icon" href="<?php Utils::generateLink('assets/favicon.png'); ?>">
</head>

<body>

	<header>
		<img id="logo" src="<?php Utils::generateLink('assets/img/logo.png'); ?>" alt="PHP MVC Boilerplate">
		<?php if (isset($DATA['title'])): ?>
		<h1><?php Security::escape($DATA['title']); ?></h1>
		<?php endif;?>
	</header>

	<nav>
		<ul>
			<li><a href="<?php Utils::generateLink(''); ?>">Home</a></li>
			<li><a href="<?php Utils::generateLink('tasks'); ?>">Tasks</a></li>
			<?php if (Session::get(Config::USER_COOKIE) === false): ?>
			<li><a href="<?php Utils::generateLink('login'); ?>">Log in</a></li>
			<?php else:?>
			<li><a onclick="return confirm('Are you sure?');" href="<?php Utils::generateLink('logout'); ?>">Log out</a></li>
			<?php endif; ?>
		</ul>
	</nav>
