<?php

/**
 * Класа за управљање сесијом.
 */
final class Session {

	/**
	 * Конфигурација сесијског колачића
	 * @var array
	 */
	private static $cookieParams = [
		'lifetime' => 0,
		'path' => '/',
		'domain' => '',
		'secure' => false,
		'httponly' => true,
		'samesite' => 'Strict'
	];

	/**
	 * Покретање сесије
	 * @return void
	 */
	final public static function begin() {
		if (Http::isHttps()) {
			$this->cookieParams['secure'] = true;
		}

		if (!session_set_cookie_params(self::$cookieParams)) {
			ob_clean();
			die('SESSION: Unable to set cookie params.');
		}
		session_start();
	}

	/**
	 * Чишћење сесијских података и прекидање сесије
	 * @return void
	 */
	final public static function end() {
		$_SESSION = [];
		session_destroy();
	}

	/**
	 * Манипулација сесијским подацима
	 * @param string $key Сесијска променљива
	 * @param mixed $value Вредност сесијске променљиве
	 */
	final public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}

	/**
	 * Враћање вредности одговарајуће сесијске променљиве
	 * @param string $key Сесијска променљива
	 * @return mixed|boolean
	 */
	final public static function get($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return false;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
