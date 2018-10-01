<?php

/**
 * Јединични тестови за sys/classes/Route.php
 */
class RouteTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @test
	 */
	public function constructor_and_getters_works() {
		$controller = 'Home';
		$method = 'index';
		$pattern = '|^/?$|';
		$route = new Route($controller, $method, $pattern);

		$this->assertEquals($controller, $route->getController());
		$this->assertEquals($method, $route->getMethod());
		$this->assertEquals($pattern, $route->getPattern());
		$this->assertEquals($route, "$controller->$method()");
	}

	/**
	 * @test
	 */
	public function matching_works() {
		$route = new Route('Home', 'index', '|^home/?$|');
		$args = null;

		$this->assertEquals(1, $route->isMatched('home', $args));
		$this->assertEquals(1, $route->isMatched('home/', $args));
		$this->assertEquals(0, $route->isMatched('home/123', $args));
	}

	/**
	 * @test
	 */
	public function matching_with_capturing_groups_works() {
		$route = new Route('Task', 'update', '|^update/([0-9]+)/?$|');
		$args = null;
		$param = 14;
		$result = $route->isMatched('update/' . $param, $args);

		$this->assertEquals(1, $result);
		$this->assertEquals($param, $args[0]);
	}

}
