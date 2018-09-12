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
		$this->set('tasks', TaskModel::getAll());
	}

}
