<?php

/**
 * Сваки контролер који служи да одговори на API позив корисника треба да прошири ову класу.
 */
abstract class ApiController extends Controller {

	/**
	 * Овај метод проверава да ли је корисник улогован
	 * @return void
	 */
	final public function __pre() {
		if (Session::get(Config::USER_COOKIE) === false) {
			http_response_code(403);
			ob_clean();
			die('HTTP 403 - Forbidden.');
		}
	}

}
