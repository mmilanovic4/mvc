<?php

// Кастомизована autoload функција
spl_autoload_register(function($className) {
	if (file_exists('./sys/classes/' . $className . '.php')) {
		require_once './sys/classes/' . $className . '.php';
	} elseif (preg_match('|^([A-Z][a-z]+)+Controller$|', $className)) {
		require_once './app/controllers/' . $className . '.php';
	} elseif (preg_match('|^([A-Z][a-z]+)+Model$|', $className)) {
		require_once './app/models/' . $className . '.php';
	} elseif ($className === 'Config') {
		require_once './sys/Config.php';
	}
});
