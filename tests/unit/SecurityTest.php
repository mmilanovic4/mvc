<?php

/**
 * Јединични тестови за sys/classes/Security.php
 */
class SecurityTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @test
	 */
	public function html_entities_are_escaped_script_tag() {
		$input = '<script>alert("!");</script>';
		$output = Security::escape($input, true);

		$this->assertContains('<script>', $input);
		$this->assertNotContains('<script>', $output);
	}

	/**
	 * @test
	 */
	public function html_entities_are_escaped_img_tag() {
		$input = '<img src=x onerror="alert(\"!\");">';
		$output = Security::escape($input, true);

		$this->assertContains('<img', $input);
		$this->assertNotContains('<img', $output);
	}

}
