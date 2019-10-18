<?php

/**
 * UserModel
 */
class UserModel extends Model {

	/**
	 * Назив табеле
	 * @var string
	 */
	protected static $tableName = 'users';

	/**
	 * Аутентификација корисника коришћењем е-поште и лозинке
	 * @param string $email Е-пошта корисника
	 * @param string $password Хеш-вредност корисничке лозинке
	 * @return object
	 */
	public static function getByEmailAndPassword($email, $password) {
		$tableName = '`' . self::$tableName . '`';
		$tableName = sprintf('`%s`', self::$tableName);

		$sql = "SELECT * FROM $tableName WHERE `email` = ? AND `password` = ? LIMIT 1;";
		$pst = DB::getInstance()->prepare($sql);
		$pst->bindValue(1, $email, PDO::PARAM_STR);
		$pst->bindValue(2, $password, PDO::PARAM_STR);
		$pst->execute();

		return $pst->fetch();
	}

}
