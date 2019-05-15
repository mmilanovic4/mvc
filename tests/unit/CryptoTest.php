<?php

/**
 * Јединични тестови за sys/classes/Crypto.php
 */
class CryptoTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @test
	 */
	public function sha512_without_salt() {
		$input = 'Hello World';
		$output = Crypto::sha512($input);

		// echo -n "Hello World" | sha512sum
		$target = '2c74fd17edafd80e8447b0d46741ee243b7eb74dd2149a0ab1b9246fb30382f27e853d8585719e0e67cbda0daa8f51671064615d645ae27acb15bfb1447f459b';

		$this->assertInternalType('string', $output);
		$this->assertEquals($output, $target);
	}

	/**
	 * @test
	 */
	public function sha512_without_salt_utf8() {
		$input = 'Милош Милановић';
		$output = Crypto::sha512($input);

		// echo -n "Милош Милановић" | sha512sum
		$target = 'd5152beb8217079c1969f52d8b732f261823feb8807333bc6418868e068082ca1555b8ec84c6048167fde7d966aac7d25cb3a0928b20e4467096b3661aade85f';

		$this->assertInternalType('string', $output);
		$this->assertEquals($output, $target);
	}

	/**
	 * @test
	 */
	public function sha512_with_salt() {
		$input = 'Hello World';
		$output = Crypto::sha512($input, true);

		// echo -n "Hello World$salt" | sha512sum
		$target = '7e63f6c0ba4214c12e430546da07617be5255ab04b52a2f6ea3725a395221aeac04dcb9c36d4f97c267e65949799ff28f6c4d715145baec922ed3956df7ce3bb';

		$this->assertInternalType('string', $output);
		$this->assertEquals($output, $target);
	}

	/**
	 * @test
	 */
	public function symmetric_encryption_and_decription() {
		$plainText = 'Hello, my name is Miloš.';
		$key = '123456789012345678901234';
		$iv = '1234567890123456';

		$encrypted = Crypto::encrypt($plainText, $key, $iv);
		$decrypted = Crypto::decrypt($encrypted, $key, $iv);

		$this->assertInternalType('string', $encrypted);
		$this->assertEquals($decrypted, $plainText);
	}

}
