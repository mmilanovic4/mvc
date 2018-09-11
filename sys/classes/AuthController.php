<?php

/**
 * Сваки контролер који захтева аутентификацију корисника треба да прошири ову класу.
 */
class AuthController extends Controller {

	/**
	 * Овај метод проверава да ли је корисник улогован
	 * @return void
	 */
	final public function __pre() {
		if (Session::get(Config::USER_COOKIE) === false) {
			Redirect::to('login');
		}
	}

}
