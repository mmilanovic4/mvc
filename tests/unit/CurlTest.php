<?php

/**
 * Јединични тестови за sys/classes/Curl.php
 * Пошто зависе од екстерних сервиса, у случају неуспеха тестова треба проверити доступност тих сервиса.
 */
class CurlTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @test
	 */
	public function get_request() {
		$query = ['fn' => 'John', 'ln' => 'Doe'];

		$response = Curl::request(
			Curl::GET,
			'https://httpbin.org/get',
			$query
		);

		$response = json_decode($response, true);
		$args = $response['args'];
		$userAgent = $response['headers']['User-Agent'];

		$this->assertEquals($userAgent, Curl::USER_AGENT);
		$this->assertEquals($query, $args);
	}

	/**
	 * @test
	 */
	public function post_request() {
		$query = ['fn' => 'John', 'ln' => 'Doe'];

		$response = Curl::request(
			Curl::POST,
			'https://httpbin.org/post',
			$query,
			['Cache-Control' => 'no-cache, no-store, must-revalidate']
		);

		$response = json_decode($response, true);
		$args = $response['form'];
		$userAgent = $response['headers']['User-Agent'];

		$this->assertEquals($userAgent, Curl::USER_AGENT);
		$this->assertEquals($query, $args);
		$this->assertArrayHasKey('Cache-Control', $response['headers']);
	}

}
