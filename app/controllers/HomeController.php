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
		// Постављање наслова
		$this->set('title', 'Home');

		// Узимање података из базе
		$user = UserModel::getById(Session::get(Config::USER_COOKIE));

		// Форматирање података за приказ
		if ($user) {
			$this->set('user', TaskController::formatFirstAndLastName($user->first_name, $user->last_name));
		} else {
			$this->set('user', false);
		}
	}

	/**
	 * Рута: /login/
	 * @return void
	 */
	public function login() {
		// Постављање наслова
		$this->set('title', 'Log in');

		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		if (!Http::isPost()) {
			if (!empty(Session::get(Config::USER_COOKIE))) {
				Redirect::to('');
			}
			return;
		}

		// Узимање података из HTTP POST променљивих
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

		// Валидација података
		if (empty($email) || empty($password) || strlen($email) > 255) {
			$this->set('message', 'Error #1!');
			return;
		}

		// Додатна валидација података
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->set('message', 'Error #2!');
			return;
		}

		// Хеш-вредност лозинке
		$password = Crypto::sha512($password, true);

		// Узимање података из базе - аутентификација корисника
		$user = UserModel::getByEmailAndPassword($email, $password);

		// Постављање сесијског колачића у случају успешне аутентификације
		if ($user) {
			Session::set(Config::USER_COOKIE, intval($user->id));
			Redirect::to('');
		} else {
			$this->set('message', 'Error #3!');
			sleep(2);
			return;
		}
	}

	/**
	 * Рута: /logout/
	 * @return void
	 */
	public function logout() {
		// Чишћење сесије
		Session::end();

		// Редирекција
		Redirect::to('');
	}

	/**
	 * Рута: HTTP 404 Not Found
	 * @return void
	 */
	public function e404() {
		// Постављање одговарајућег HTTP статус кода
		http_response_code(404);

		// Порука о грешци
		ob_clean();
		die('HTTP: 404 not found.');
	}

}
