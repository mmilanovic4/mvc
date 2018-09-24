<!DOCTYPE html>
<html>

<head>
	<title><?php echo isset($DATA['title']) ? $DATA['title'] . ' | MVC' : 'MVC'; ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipiscing elit.">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php Utils::generateLink('assets/css/main.css'); ?>">
</head>

<body>

	<header>
		<?php if (isset($DATA['title'])): ?>
		<h1><?php Security::escape($DATA['title']); ?></h1>
		<?php endif;?>
	</header>

	<nav>
		<ul>
			<li><a href="<?php Utils::generateLink(''); ?>">Home</a></li>
			<li><a href="<?php Utils::generateLink('tasks'); ?>">Tasks</a></li>
			<?php if (!Session::get(Config::USER_COOKIE)): ?>
			<li><a href="<?php Utils::generateLink('login'); ?>">Log In</a></li>
			<?php else:?>
			<li><a onclick="return confirm('Are you sure?');" href="<?php Utils::generateLink('logout'); ?>">Log Out</a></li>
			<?php endif; ?>
		</ul>
	</nav>
