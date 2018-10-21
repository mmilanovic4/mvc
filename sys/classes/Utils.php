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
	 * @param string $path Линк
	 * @return string
	 */
	final public static function generateLink($path) {
		return Config::BASE . $path;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
