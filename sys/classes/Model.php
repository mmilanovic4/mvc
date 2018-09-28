<?php

/**
 * Основна класа модела. Сваки модел треба да проширује ову класу.
 */
abstract class Model {

	/**
	 * Враћање имена табеле
	 * @return string
	 */
	private static function getTableName() {
		$className = get_called_class();

		if (property_exists($className, 'tableName')) {
			$classVars = get_class_vars($className);
			return '`' . $classVars['tableName'] . '`';
		}

		ob_clean();
		die('Model error - unknown property.');
	}

	/**
	 * Враћање свих редова из табеле
	 * <code>
	 * 	Model::getAll();
	 * </code>
	 * @return array
	 */
	public static function getAll() {
		$sql = 'SELECT * FROM ' . self::getTableName() . ';';
		$pst = Database::getInstance()->prepare($sql);
		$pst->execute();
		return $pst->fetchAll();
	}

	/**
	 * Враћање реда из табеле који има одговарајући ID параметар
	 * <code>
	 * 	Model::getById($id);
	 * </code>
	 * @param int $id ID параметар
	 * @return array
	 */
	public static function getById($id) {
		$sql = 'SELECT * FROM ' . self::getTableName() . ' WHERE `id` = ?;';
		$pst = Database::getInstance()->prepare($sql);
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
		$tableName = self::getTableName();
		$fields = $placeholders = $values = [];

		if (!is_array($data) || count($data) === 0) {
			ob_clean();
			die('Model error - wrong input.');
		}

		foreach ($data as $field => $value) {
			$fields[] = "`$field`";
			$values[] = $value;
			$placeholders[] = '?';
		}

		$fields = '(' . implode(', ', $fields) . ')';
		$placeholders = '(' . implode(', ', $placeholders) . ')';

		$sql = "INSERT INTO $tableName $fields VALUES $placeholders;";
		$pst = Database::getInstance()->prepare($sql);

		if (!$pst) {
			return false;
		}

		if (!$pst->execute($values)) {
			return false;
		}

		return Database::getInstance()->lastInsertId();
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
		$tableName = self::getTableName();
		$fields = $values = [];

		if (!is_array($data) || count($data) === 0) {
			ob_clean();
			die('Model error - wrong input.');
		}

		foreach ($data as $field => $value) {
			$fields[] = "`$field` = ?";
			$values[] = $value;
		}

		$fields = implode(', ', $fields);
		$values[] = intval($id);

		$sql = "UPDATE $tableName SET $fields WHERE `id` = ?;";
		$pst = Database::getInstance()->prepare($sql);

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
		$sql = 'DELETE FROM ' . self::getTableName() . ' WHERE `id` = ?;';
		$pst = Database::getInstance()->prepare($sql);
		$pst->bindValue(1, intval($id), PDO::PARAM_INT);
		return $pst->execute();
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
