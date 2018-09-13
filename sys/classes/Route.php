<?php

/**
 * Класа која дефинише руту.
 */
final class Route {

	/**
	 * Назив контролера
	 * @var string
	 */
	private $controller;

	/**
	 * Назив метода контролера
	 * @var string
	 */
	private $method;

	/**
	 * Регуларни израз путање руте
	 * @var string
	 */
	private $pattern;

	/**
	 * Конструктор
	 * @param string $controller Назив контролера
	 * @param string $method Назив метода контролера
	 * @param string $pattern Регуларни израз путање руте
	 * @return void
	 */
	public function __construct($controller, $method, $pattern) {
		$this->controller = $controller;
		$this->method = $method;
		$this->pattern = $pattern;
	}

	/**
	 * Враћа вредност $controller атрибута
	 * @return string
	 */
	public function getController() {
		return $this->controller;
	}

	/**
	 * Враћа вредност $method атрибута
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * Враћа вредност $pattern атрибута
	 * @return string
	 */
	public function getPattern() {
		return $this->pattern;
	}

	/**
	 * Стринг репрезентација објекта
	 * @return string
	 */
	public function __toString() {
		return $this->controller . '->' . $this->method . '()';
	}

}
