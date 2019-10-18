<?php

/**
 * Класа за рад са базом података - управљање конекцијом.
 */
final class DB {

	/**
	 * PDO хендлер
	 * @var PDO|null
	 */
	private static $dbh = null;

	/**
	 * Успоставља конекцију са сервером БП (користећи Синглтон патерн) и враћа инстанцу PDO хендлера
	 * @return PDO
	 */
	final public static function getInstance() {
		if (self::$dbh === null) {
			$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', Config::DB_HOST, Config::DB_NAME);
			try {
				self::$dbh = new PDO($dsn, Config::DB_USER, Config::DB_PASS, [
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
				]);
			} catch (PDOException $e) {
				error_log($e->getMessage());
				ob_clean();
				die('DATABASE: Connection error.');
			}
		}
		return self::$dbh;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
