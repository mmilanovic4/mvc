<?php

/**
 * Класа за рад са базом података - управљање конекцијом.
 */
final class Database {

	/**
	 * PDO хендлер
	 * @var PDO|null
	 */
	private static $dbh = null;

	/**
	 * Конфигурациони параметри
	 * @var array
	 */
	private static $config = [
		'host=' . Config::DB_HOST,
		'dbname=' . Config::DB_NAME,
		'charset=utf8'
	];

	/**
	 * Успоставља конекцију са сервером БП (користећи Синглтон патерн) и враћа инстанцу PDO хендлера
	 * @return PDO
	 */
	final public static function getInstance() {
		if (self::$dbh === null) {
			$dsn = 'mysql:' . implode(';', self::$config);
			try {
				self::$dbh = new PDO($dsn, Config::DB_USER, Config::DB_PASS);
				self::$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			} catch (PDOException $e) {
				error_log($e->getMessage());
				ob_clean();
				die('Database connection error!');
			}
		}
		return self::$dbh;
	}

	/**
	 * "Искључивање" конструктора.
	 */
	private function __construct() {}

}
