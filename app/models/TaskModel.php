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
	 * @todo heredoc синтакса изгледа лепше од PHP верзије 7.3, са преласком на ту верзију измени SQL упит
	 */
	public static function getAllFromInnerJoinWithUsers() {
		$tasks = self::getTableName();
		$users = UserModel::getTableName();

		/**
		 * Редослед табела у SELECT реду је битан јер желимо да `id` поље из табеле `tasks` прегази `id` поље из табеле `users`
		 */
		$sql = <<<END
		SELECT `$users`.*, `$tasks`.*
		FROM `$tasks` INNER JOIN `$users`
		ON `$tasks`.`user_id` = `$users`.`id`;
END;
		$pst = Database::getInstance()->prepare($sql);
		$pst->execute();
		return $pst->fetchAll();
	}

}
