<?php

/**
 * HomeController
 */
class HomeController extends Controller {

	/**
	 * Рута: /
	 * @return void
	 */
	public function index() {
		$this->set('title', 'Home');

		$user = UserModel::getById(Session::get(Config::USER_COOKIE));
		if ($user) {
			$userParsed = Security::escape($user->first_name . ' ' . $user->last_name);
			$this->set('user', $userParsed);
		} else {
			$this->set('user', false);
		}
	}

	/**
	 * Рута: /login/
	 * @return void
	 */
	public function login() {
		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
		if ($method === 'POST') {
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

			if (empty($email) || empty($password) || strlen($email) > 255) {
				$this->set('message', 'Error #1!');
				return;
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->set('message', 'Error #2!');
				return;
			}

			$password = Crypto::sha512($password, true);
			$user = UserModel::getByEmailAndPassword($email, $password);

			if ($user) {
				Session::set(Config::USER_COOKIE, intval($user->id));
				Redirect::to('');
			} else {
				$this->set('message', 'Error #3!');
				sleep(2);
				return;
			}
		} else {
			if (Session::get(Config::USER_COOKIE) !== false) {
				Redirect::to('');
			}
			$this->set('title', 'Log In');
		}
	}

	/**
	 * Рута: /logout/
	 * @return void
	 */
	public function logout() {
		Session::end();
		Redirect::to('');
	}

}
