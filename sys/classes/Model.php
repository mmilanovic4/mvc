<?php

/**
 * Основна класа модела. Сваки модел треба да проширује ову класу.
 */
abstract class Model {

	/**
	 * Назив табеле
	 * @var string
	 */
	protected static $tableName = null;

	/**
	 * Враћање имена табеле
	 * @return string
	 */
	protected static function getTableName() {
		if (!empty(static::$tableName)) {
			return static::$tableName;
		}

		ob_clean();
		die('MODEL: Table name not defined.');
	}

	/**
	 * Враћање свих редова из табеле
	 * <code>
	 * 	Model::getAll();
	 * </code>
	 * @return array
	 */
	public static function getAll() {
		$tableName = sprintf('`%s`', self::getTableName());

		$sql = "SELECT * FROM $tableName;";
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute();

		return $pst->fetchAll();
	}

	/**
	 * Враћање реда из табеле који има одговарајући ID параметар
	 * <code>
	 * 	Model::getById($id);
	 * </code>
	 * @param int $id ID параметар
	 * @return object|bool
	 */
	public static function getById($id) {
		$tableName = sprintf('`%s`', self::getTableName());

		$sql = "SELECT * FROM $tableName WHERE `id` = ?;";
		$pst = DB::getInstance()->prepare($sql);
		$pst->bindValue(1, intval($id), PDO::PARAM_INT);
		$pst->execute();

		return $pst->fetch();
	}

	/**
	 * Додавање новог реда у табелу
	 * <code>
	 * 	Model::create([
	 * 		'field_1' => 'value_1',
	 * 		'field_2' => 'value_2'
	 * 	]);
	 * </code>
	 * @param array $data Улазни параметри
	 * @return int|bool
	 */
	public static function create($data) {
		$tableName = sprintf('`%s`', self::getTableName());
		$fields = $placeholders = $values = [];

		if (!is_array($data) || empty($data)) {
			ob_clean();
			die('MODEL: Bad input for create.');
		}

		foreach ($data as $field => $value) {
			$fields[] = "`$field`";
			$values[] = $value;
			$placeholders[] = '?';
		}

		$fields = '(' . implode(', ', $fields) . ')';
		$placeholders = '(' . implode(', ', $placeholders) . ')';

		$sql = "INSERT INTO $tableName $fields VALUES $placeholders;";
		$pst = DB::getInstance()->prepare($sql);

		if (!$pst) {
			return false;
		}

		if (!$pst->execute($values)) {
			return false;
		}

		return DB::getInstance()->lastInsertId();
	}

	/**
	 * Ажурирање реда у табели који има одговарајући ID параметар
	 * <code>
	 * 	Model::update($id, [
	 * 		'field_1' => 'value_1',
	 * 		'field_2' => 'value_2'
	 * 	]);
	 * </code>
	 * @param int $id ID параметар
	 * @param array $data Остали улазни параметри
	 * @return bool
	 */
	public static function update($id, $data) {
		$tableName = sprintf('`%s`', self::getTableName());
		$fields = $values = [];

		if (!is_array($data) || empty($data)) {
			ob_clean();
			die('MODEL: Bad input for update.');
		}

		foreach ($data as $field => $value) {
			$fields[] = "`$field` = ?";
			$values[] = $value;
		}

		$fields = implode(', ', $fields);
		$values[] = intval($id);

		$sql = "UPDATE $tableName SET $fields WHERE `id` = ?;";
		$pst = DB::getInstance()->prepare($sql);

		if (!$pst) {
			return false;
		}

		return $pst->execute($values);
	}

	/**
	 * Уклањање реда у табели који има одговарајући ID параметар
	 * <code>
	 * 	Model::delete($id);
	 * </code>
	 * @param int $id ID параметар
	 * @return bool
	 */
	public static function delete($id) {
		$tableName = sprintf('`%s`', self::getTableName());

		$sql = "DELETE FROM $tableName WHERE `id` = ?;";
		$pst = DB::getInstance()->prepare($sql);
		$pst->bindValue(1, intval($id), PDO::PARAM_INT);

		return $pst->execute();
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
