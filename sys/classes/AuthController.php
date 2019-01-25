<?php

/**
 * Сваки контролер који захтева аутентификацију корисника треба да прошири ову класу.
 */
abstract class AuthController extends Controller {

	/**
	 * Овај метод проверава да ли је корисник улогован
	 * @return void
	 */
	final public function __pre() {
		if (empty(Session::get(Config::USER_COOKIE))) {
			Redirect::to('login');
		}
	}

}
