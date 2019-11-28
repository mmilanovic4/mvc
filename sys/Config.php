<?php

/**
 * Конфигурациони фајл
 */
final class Config {

	/**
	 * Апсолутни линк апликације
	 * @var string
	 */
	const BASE = 'http://localhost/dev/mvc/';

	/**
	 * Релативни линк апликације (на продукцији најчешће само '/')
	 */
	const PATH = '/dev/mvc/';

	/**
	 * Сервер БП: име хоста
	 * @var string
	 */
	const DB_HOST = 'localhost';

	/**
	 * Сервер БП: корисничко име
	 * @var string
	 */
	const DB_USER = 'root';

	/**
	 * Сервер БП: лозинка
	 * @var string
	 */
	const DB_PASS = '';

	/**
	 * Сервер БП: име базе
	 * @var string
	 */
	const DB_NAME = 'mvc';

	/**
	 * Сесијска променљива у којој ће бити складиштен корисников ИД приликом пријаве
	 * @var string
	 */
	const USER_COOKIE = 'user_id';

	/**
	 * Случајни или псеудо-случајни стринг произвољне дужине
	 * @var string
	 */
	const SALT = '34aa3fb2c440cac0b1cdbb49146a2f34';

}
