<?php

/**
 * Функције везане за безбедност.
 */
final class Security {

	/**
	 * XSS заштита
	 * @param string $str Улазни стринг
	 * @return string Улазни стринг са енкодованим HTML ентитетима
	 */
	final public static function escape($str) {
		return htmlentities($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
