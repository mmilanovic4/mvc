<?php

/**
 * TaskApiController
 */
class TaskApiController extends ApiController {

	/**
	 * Рута: /api/tasks
	 * cURL example:
	 * <code>
	 * 	curl http://localhost/dev/MVC/api/tasks --cookie "PHPSESSID=$yourSessionId"
	 * </code>
	 * @return void
	 */
	public function index() {
		// Обустави даљу обраду захтева у случају да није одговарајућа HTTP метода
		Http::checkMethodIsAllowed('GET');

		// Узимање података из базе
		$tasks = TaskModel::getAll();

		// Прослеђивање података слоју приказа
		$this->set('tasks', $tasks);
	}

}
