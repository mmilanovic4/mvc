<?php

/**
 * Кастомизована autoload функција
 * @return bool
 */
spl_autoload_register(function($className) {
	if (file_exists('./sys/classes/' . $className . '.php')) {
		// Укључивање класа из sys/classes фолдера
		require_once './sys/classes/' . $className . '.php';
		return true;
	} elseif (preg_match('|^(?:[A-Z][a-z]+)+Controller$|', $className)) {
		// Укључивање контролера
		require_once './app/controllers/' . $className . '.php';
		return true;
	} elseif (preg_match('|^(?:[A-Z][a-z]+)+Model$|', $className)) {
		// Укључивање модела
		require_once './app/models/' . $className . '.php';
		return true;
	} elseif ($className === 'Config') {
		// Укључивање конфигурационог фајла
		if (file_exists('./sys/Config.php')) {
			require_once './sys/Config.php';
			return true;
		} else {
			ob_clean();
			die('AUTOLOAD: Configuration file not found.');
		}
	}
	// Класа није пронађена
	return false;
});
