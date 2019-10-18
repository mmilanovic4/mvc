<?php

/**
 * TaskModel
 */
class TaskModel extends Model {

	/**
	 * Назив табеле
	 * @var string
	 */
	protected static $tableName = 'tasks';

	/**
	 * Враћање свих редова из табеле - INNER JOIN са табелом `users`
	 * @return array
	 */
	public static function getAllFromInnerJoinWithUsers() {
		$tasks = sprintf('`%s`', self::getTableName());
		$users = sprintf('`%s`', UserModel::getTableName());

		/**
		 * Редослед табела у SELECT реду је битан јер желимо да `id` поље из табеле `tasks` прегази `id` поље из табеле `users`
		 */
		$sql = <<<END
		SELECT $tasks.*, $users.`first_name`, $users.`last_name`
		FROM $tasks INNER JOIN $users
		ON $tasks.`user_id` = $users.`id`;
		END;

		$pst = DB::getInstance()->prepare($sql);
		$pst->execute();

		return $pst->fetchAll();
	}

}
