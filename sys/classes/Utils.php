<?php

require_once './sys/classes/traits/DateUtils.php';
require_once './sys/classes/traits/StringUtils.php';

/**
 * Разне помоћне функције.
 */
final class Utils {

	use DateUtils, StringUtils;

	/**
	 * Исписивање нормализованог линка
	 * За апсолутне путање: заменимо PATH са BASE
	 * @param string $path Линк
	 * @return string
	 */
	final public static function generateLink($path) {
		return Config::PATH . $path;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
