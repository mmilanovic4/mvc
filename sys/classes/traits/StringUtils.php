<?php

/**
 * Помоћне функције за рад са стринговима
 */
trait StringUtils {

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

}
