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
	 * Број секунди дозвољен cURL функцији да се извршава
	 * @var int
	 */
	const TIMEOUT = 3;

	/**
	 * User-Agent заглавље
	 * @var string
	 */
	const USER_AGENT = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:62.0) Gecko/20100101 Firefox/62.0';

	/**
	 * Бела листа заглавља
	 * @var array
	 */
	const WHITELISTED_HEADERS = [
		'Accept',
		'Cache-Control',
		'X-Csrf-Token',
	];

	/**
	 * Шаблон захтева
	 * @param int $method Тип захтева
	 * @param string $url Униформни локатор ресурса
	 * @param array $query Упит (може бити прослеђен и кроз URL за захтеве типа GET)
	 * @param array $headers Заглавља - провери белу листу
	 * @return string|bool
	 */
	final public static function request($method = self::GET, $url, $query = [], $headers = []) {
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

		$headersParsed = [];
		foreach ($headers as $header => $value) {
			$header = ucwords(strtolower($header), '-');
			if (in_array($header, self::WHITELISTED_HEADERS)) {
				$headersParsed[] = "$header: $value";
			}
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headersParsed);

		$res = curl_exec($ch);
		$status = intval(curl_getinfo($ch, CURLINFO_RESPONSE_CODE));

		curl_close($ch);

		if ($status !== 200 || empty($res)) {
			return false;
		}

		return $res;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
