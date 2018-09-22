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
		$tasks = TaskModel::getAll();
		$this->set('tasks', $tasks);
	}

}
