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
		echo Config::BASE . $path;
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
	 * Форматирање датума и времена - MySQL временски печат
	 * @param string MySQL временски печат
	 * @return string
	 */
	final public static function formatDateAndTime($ts) {
		return date('H:i:s d.m.Y', strtotime($ts));
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
