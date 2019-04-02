<?php

/**
 * Фасадни приступ cURL функцијама
 */
class Curl {

	/**
	 * GET захтев
	 * @var int
	 */
	const GET = CURLOPT_HTTPGET;

	/**
	 * POST захтев
	 * @var int
	 */
	const POST = CURLOPT_POST;

	/**
	 * HTTP Basic аутентификација
	 * @var int
	 */
	const AUTH_BASIC = CURLAUTH_BASIC;

	/**
	 * HTTP Digest аутентификација
	 * @var int
	 */
	const AUTH_DIGEST = CURLAUTH_DIGEST;

	/**
	 * Број секунди дозвољен cURL функцији да се извршава
	 * @var int
	 */
	const TIMEOUT = 3;

	/**
	 * User-Agent заглавље
	 * @var string
	 */
	const USER_AGENT = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0';

	/**
	 * Бела листа заглавља
	 * @var array
	 */
	const WHITELISTED_HEADERS = [
		'Accept',
		'Cache-Control',
		'X-Csrf-Token'
	];

	/**
	 * Шаблон захтева
	 * @param int $method Тип захтева
	 * @param string $url Униформни локатор ресурса
	 * @param array|bool $query Упит (може бити прослеђен и кроз URL за захтеве типа GET)
	 * @param array|bool $headers Заглавља - провери белу листу
	 * @param array|bool $auth HTTP аутентификација @see Curl::authParams
	 * @return string|bool
	 */
	final public static function request($method = self::GET, $url, $query = false, $headers = false, $auth = false) {
		if (!in_array($method, [self::GET, self::POST])) {
			return false;
		}

		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			return false;
		}

		$ch = curl_init();

		if ($method === self::GET && !empty($query)) {
			$url = $url . '?' . http_build_query($query);
		} elseif ($method === self::POST) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
		}

		curl_setopt_array($ch, [
			CURLOPT_URL => $url,
			$method => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => self::TIMEOUT,
			CURLOPT_USERAGENT => self::USER_AGENT,
		]);

		if (is_array($headers)) {
			$headersParsed = [];

			foreach ($headers as $header => $value) {
				$header = ucwords(strtolower($header), '-');
				if (in_array($header, self::WHITELISTED_HEADERS)) {
					$headersParsed[] = "$header: $value";
				}
			}

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headersParsed);
		}

		if ($auth) {
			foreach ($auth as $option => $value) {
				curl_setopt($ch, $option, $value);
			}
		}

		$res = curl_exec($ch);
		$status = intval(curl_getinfo($ch, CURLINFO_RESPONSE_CODE));

		curl_close($ch);

		if ($status !== 200 || empty($res)) {
			return false;
		}

		return $res;
	}

	/**
	 * Припрема параметара за HTTP аутентификацију
	 * @param int $type Тип аутентификације
	 * @param string $username Корисничко име
	 * @param string $password Лозинка
	 * @return array|bool
	 */
	final public static function authParams($type = self::AUTH_BASIC, $username, $password) {
		if (!in_array($type, [self::AUTH_BASIC, self::AUTH_DIGEST])) {
			return false;
		}

		if (!is_string($username) || !is_string($password)) {
			return false;
		}

		return [
			CURLOPT_HTTPAUTH => $type,
			CURLOPT_USERPWD => $username . ':' . $password
		];
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
