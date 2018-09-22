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
		$this->set('title', 'Tasks');

		$tasks = TaskModel::getAll();
		foreach ($tasks as $task) {
			$task->created_at = Utils::formatDateAndTime($task->created_at);
			$author = UserModel::getById($task->author);

			if (!$author) {
				$task->author = 'N/A';
			} else {
				$task->author = $author->first_name . ' ' . $author->last_name;
			}
		}
		$this->set('tasks', $tasks);
	}

	/**
	 * Рута: /tasks/create/
	 * @return void
	 */
	public function create() {
		$this->set('title', 'Add task');

		if (!Http::isPost()) {
			return;
		}

		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			return;
		}

		$author = intval(Session::get(Config::USER_COOKIE));
		$task = TaskModel::create([
			'name' => $name,
			'description' => $description,
			'author' => $author
		]);

		if (!$task) {
			$this->set('message', 'Error #2!');
			return;
		}
		Redirect::to('tasks');
	}

	/**
	 * Рута: /tasks/update/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function update($id) {
		$this->set('title', 'Update task');

		if (!Http::isPost()) {
			$task = TaskModel::getById($id);
			$this->set('task', $task);
			return;
		}

		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

		if (empty($name) || empty($description)) {
			$this->set('message', 'Error #1!');
			$task = TaskModel::getById($id);
			$this->set('task', $task);
			return;
		}

		$author = intval(Session::get(Config::USER_COOKIE));
		$status = TaskModel::update($id, [
			'name' => $name,
			'description' => $description,
			'author' => $author
		]);

		if (!$status) {
			$this->set('message', 'Error #2!');
			$task = TaskModel::getById($id);
			$this->set('task', $task);
			return;
		}
		Redirect::to('tasks');
	}

	/**
	 * Рута: /tasks/delete/$id
	 * @param int $id ID параметар
	 * @return void
	 */
	public function delete($id) {
		TaskModel::delete($id);
		Redirect::to('tasks');
	}

}
