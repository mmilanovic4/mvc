<?php

/**
 * Функције везане за протокол за пренос хипертекста.
 */
final class Http {

	/**
	 * Детектује да ли је у питању HTTP POST захтев
	 * @return bool
	 */
	final public static function isPost() {
		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
		$method = strtoupper($method);
		return $method === 'POST';
	}

	/**
	 * Детектује да ли је коришћен HTTPS
	 * @return bool
	 */
	final public static function isHttps() {
		$c1 = filter_input(INPUT_SERVER, 'HTTPS') !== null;
		$c2 = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
		$c2 = intval($c2) === 443;

		if ($c1 || $c2) {
			return true;
		}
		return false;
	}

	/**
	 * Нормализује и враћа захтевану путању
	 * @return string
	 */
	final public static function getRequest() {
		$request = filter_input(INPUT_SERVER, 'REQUEST_URI');
		$request = substr($request, strlen(Config::PATH));
		return $request;
	}

	/**
	 * Поставља уобичајна заглавља за JSON одговор
	 * @return void
	 */
	final public static function setJsonHeaders() {
		header('Content-Type: application/json; charset=utf-8');
		header('Access-Control-Allow-Origin: *'); // Измени пре продукције
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
