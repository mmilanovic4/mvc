<?php

/**
 * TaskController
 */
class TaskController extends AuthController {

	/**
	 * Рута: /tasks/
	 * @return void
	 */
	public function index() {
		// Постављање наслова
		$this->set('title', 'Tasks');

		// Узимање података из базе
		$tasks = TaskModel::getAllFromInnerJoinWithUsers();

		// Форматирање података за приказ
		foreach ($tasks as $task) {
			$task->created_at = Utils::formatDateAndTime($task->created_at);
			$task->user = $this->formatFirstAndLastName($task->first_name, $task->last_name);
		}

		// Прослеђивање података слоју приказа
		$this->set('tasks', $tasks);
	}

	/**
	 * Рута: /tasks/create/
	 * @return void
	 */
	public function create() {
		// Постављање наслова
		$this->set('title', 'Add task');

		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		if (!Http::isPost()) {
			return;
		}

		// Узимање података из HTTP POST променљивих
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		// Валидација података
		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			return;
		}

		// Нормализација података пре уписа у базу
		$userId = intval(Session::get(Config::USER_COOKIE));
		$name = trim($name);
		$description = trim($description);

		// Упис података у базу
		$task = TaskModel::create([
			'user_id' => $userId,
			'name' => $name,
			'description' => $description
		]);

		// Повратак на формулар у случају неуспелог уписа у базу
		if (!$task) {
			$this->set('message', 'Error #2!');
			return;
		}

		// Редирекција
		Redirect::to('tasks');
	}

	/**
	 * Рута: /tasks/update/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function update($id) {
		// Постављање наслова
		$this->set('title', 'Update task');

		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		if (!Http::isPost()) {
			$this->setTask($id);
			return;
		}

		// Узимање података из HTTP POST променљивих
		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		// Валидација података
		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			$this->setTask($id);
			return;
		}

		// Нормализација података пре уписа у базу
		$userId = intval(Session::get(Config::USER_COOKIE));
		$name = trim($name);
		$description = trim($description);

		// Ажурирање података у бази
		$status = TaskModel::update($id, [
			'user_id' => $userId,
			'name' => $name,
			'description' => $description
		]);

		// Повратак на формулар у случају неуспелог уписа у базу
		if (!$status) {
			$this->set('message', 'Error #2!');
			$this->setTask($id);
			return;
		}

		// Редирекција
		Redirect::to('tasks');
	}

	/**
	 * Рута: /tasks/delete/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function delete($id) {
		// Уклањање података из базе
		TaskModel::delete($id);

		// Редирекција
		Redirect::to('tasks');
	}

	/**
	 * Враћа ред из табеле по ID параметру и складишти га у податке за приказ
	 * @param int $id ID параметар
	 * @return void
	 */
	private function setTask($id, $name = 'task') {
		// Узимање података из базе
		$task = TaskModel::getById($id);

		// Прослеђивање података слоју приказа
		$this->set($name, $task);
	}

	/**
	 * Форматира име и презиме корисника за приказ
	 * @param string $firstName Име
	 * @param string $lastName Презиме
	 * @return string
	 */
	public static function formatFirstAndLastName($firstName, $lastName) {
		$user = trim(implode(' ', [$firstName, $lastName]));
		return $user ? $user : 'N/A';
	}

}
