<?php

/**
 * Функције везане за криптографију.
 */
final class Crypto {

	/**
	 * SHA-512 хеш-функција
	 * @param string $password Улаз хеш-функције
	 * @param bool $salt Вредност треба бити true ако користимо, односно false ако не користимо $salt параметар
	 * @return string Излаз хеш-функције
	 */
	final public static function sha512($password, $salt = false) {
		if ($salt) {
			return hash('sha512', $password . Config::SALT);
		} else {
			return hash('sha512', $password);
		}
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
