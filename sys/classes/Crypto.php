<?php

/**
 * Функције везане за криптографију.
 */
final class Crypto {

	/**
	 * Алгоритам за симетрично блок шифровање
	 * @var string
	 */
	private static $algo = 'aes-256-cbc';

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
	 * Симетрично блок шифровање, излаз је у Base64 формату
	 * @param string $plainText Отворени текст
	 * @param string $key Симетрични кључ (aes-256-cbc = 256 бита)
	 * @param string $iv Иницијализациони вектор (aes-256-cbc = 128 бита)
	 * @return string
	 */
	final public static function encrypt($plainText, $key, $iv = false) {
		$cipherText = openssl_encrypt($plainText, self::$algo, $key, OPENSSL_RAW_DATA, $iv);
		return base64_encode($cipherText);
	}

	/**
	 * Симетрично блок дешифровање, улаз је у Base64 формату
	 * @param string $cipherTextEncoded Шифрат
	 * @param string $key Симетрични кључ (aes-256-cbc = 256 бита)
	 * @param string $iv Иницијализациони вектор (aes-256-cbc = 128 бита)
	 * @return string
	 */
	final public static function decrypt($cipherTextEncoded, $key, $iv = false) {
		$cipherText = base64_decode($cipherTextEncoded);
		$decrypted = openssl_decrypt($cipherText, self::$algo, $key, OPENSSL_RAW_DATA, $iv);
		return $decrypted;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
