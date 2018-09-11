<?php

/**
 * AdminController
 */
class AdminController extends AuthController {

	/**
	 * Рута: /admin/
	 * @return void
	 */
	public function index() {
		$this->set('title', 'Admin Panel');

		$user = UserModel::getById(Session::get(Config::USER_COOKIE));
		if (!$user) {
			ob_clean();
			die('AdminController error - unknown user.');
		}

		$userParsed = Security::escape($user->first_name . ' ' . $user->last_name);
		$this->set('user', $userParsed);
	}

}
