<?php

/**
 * Кастомизована autoload функција
 * @param string $className Назив класе
 * @return bool
 */
spl_autoload_register(function($className) {
	$path = null;
	if (file_exists('./sys/classes/' . $className . '.php')) {
		// Укључивање класа из sys/classes фолдера
		$path = './sys/classes/' . $className . '.php';
	} elseif (preg_match('|^(?:[A-Z][a-z]+)+Controller$|', $className)) {
		// Укључивање контролера
		$path = './app/controllers/' . $className . '.php';
	} elseif (preg_match('|^(?:[A-Z][a-z]+)+Model$|', $className)) {
		// Укључивање модела
		$path = './app/models/' . $className . '.php';
	} elseif ($className === 'Config') {
		// Укључивање конфигурационог фајла
		$path = './sys/Config.php';
	} else {
		// Класа није пронађена
		die('AUTOLOAD: Class not found.');
	}

	// Учитавање фајла
	if (file_exists($path)) {
		require_once $path;
		return true;
	}

	// Фајл није пронађен
	die('AUTOLOAD: File not found.');
});
