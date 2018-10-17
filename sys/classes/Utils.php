<?php

/**
 * Разне помоћне функције.
 */
final class Utils {

	/**
	 * Исписивање нормализованог линка
	 * @param string $path Линк
	 * @return string
	 */
	final public static function generateLink($path) {
		return Config::BASE . $path;
	}

	/**
	 * Копија Ларавелове dd функције
	 * @param mixed $var Променљива
	 * @return void
	 */
	final public static function dd($var) {
		ob_clean();
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
		die;
	}

	/**
	 * Форматирање датума и времена
	 * @param string PHP или MySQL временски печат
	 * @return string
	 */
	final public static function formatDateAndTime($ts) {
		if (is_string($ts)) {
			$ts = strtotime($ts);
		}
		return date('H:i:s d.m.Y', $ts);
	}

	/**
	 * Провера да ли се одређени стринг завршава са другим подстрингом
	 * @param string $haystack Први стринг
	 * @param string $needle Други стринг
	 * @return bool
	 */
	final public static function endsWith($haystack, $needle) {
		$haystack = substr($haystack, -strlen($needle));
		return $haystack === $needle;
	}

	/**
	 * Провера да ли одређени стринг почиње са другим подстрингом
	 * @param string $haystack Први стринг
	 * @param string $needle Други стринг
	 * @return bool
	 */
	final public static function startsWith($haystack, $needle) {
		$haystack = substr($haystack, 0, strlen($needle));
		return $haystack === $needle;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
