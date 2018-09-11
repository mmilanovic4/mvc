<?php

/**
 * Класа за рад са редирекцијом.
 */
final class Redirect {

	/**
	 * Унутрашња редирекција
	 * @param string $link Релативни линк ка унутрашњем ресурсу
	 */
	final public static function to($link) {
		ob_clean();
		header('Location: ' . Config::BASE . $link);
		die;
	}

	/**
	 * Спољашња редирекција
	 * @param string $link Апсолутни линк ка (спољашњем) ресурсу
	 */
	final public static function absolute($link) {
		ob_clean();
		header('Location: ' . $link);
		die;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
