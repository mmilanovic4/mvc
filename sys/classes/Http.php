<?php

/**
 * Функције везане за протокол за пренос хипертекста.
 */
final class Http {

	/**
	 * Детектује да ли је у питању HTTP GET захтев
	 * @return bool
	 */
	final public static function isGet() {
		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
		$method = strtoupper($method);
		return $method === 'GET';
	}

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
	 * Проверава да ли је у питању одговарајућа HTTP метода
	 * @param string|array $method Прихвата следеће формате: 'GET', 'GET|HEAD', 'GET|HEAD|POST'...
	 * @return void
	 */
	final public static function checkMethodIsAllowed($allowedMethods = 'GET') {
		$allowedMethods = explode('|', $allowedMethods);
		$requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

		foreach ($allowedMethods as $method) {
			$method = strtoupper($method);
			if ($method === $requestMethod) {
				return;
			}
		}

		http_response_code(405);
		ob_clean();
		die('HTTP: 405 method not allowed.');
	}

	/**
	 * Детектује да ли је коришћен HTTPS
	 * @see http://php.net/manual/en/reserved.variables.server.php
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
	final public static function getRequestedPath() {
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
		// header('Access-Control-Allow-Origin: *');
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
