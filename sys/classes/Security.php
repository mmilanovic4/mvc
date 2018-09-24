<?php

/**
 * Функције везане за безбедност.
 */
final class Security {

	/**
	 * XSS заштита
	 * @param string $str Улазни стринг
	 * @return void|string Улазни стринг са енкодованим HTML ентитетима
	 */
	final public static function escape($str, $return = false) {
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8');
		if ($return) {
			return $str;
		}
		echo $str;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
