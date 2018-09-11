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
	 * @return array
	 */
	public static function getByEmailAndPassword($email, $password) {
		$sql = 'SELECT * FROM ' . self::$tableName . ' WHERE `email` = ? AND `password` = ?;';
		$pst = Database::getInstance()->prepare($sql);
		$pst->bindValue(1, $email, PDO::PARAM_STR);
		$pst->bindValue(2, $password, PDO::PARAM_STR);
		$pst->execute();
		return $pst->fetch();
	}

}
