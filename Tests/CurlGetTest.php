<?php

use AKEB\CurlGet\CurlGet;

error_reporting(E_ALL);

class CurlGetTest extends PHPUnit\Framework\TestCase {


	public function testUrlParser() {
		$curl = new CurlGet('https://google.com', [], [], []);
		$this->assertTrue(($curl instanceof CurlGet));
		$this->assertEquals($curl->unparse_url(), 'https://google.com');
		$curl->addGET([
			'a' => 1,
			'b' => 2,
		]);
		$this->assertEquals($curl->unparse_url(), 'https://google.com?a=1&b=2');
		$curl->setGET([
			'a' => 1,
			'b' => [
				'c' => 2,
				'd' => 3
			],
			'e' => [4,5,6]
		]);
		$this->assertEquals($curl->unparse_url(), 'https://google.com?a=1&b%5Bc%5D=2&b%5Bd%5D=3&e%5B0%5D=4&e%5B1%5D=5&e%5B2%5D=6');
		$curl->setGet();
		$curl->setUrl('https://user@pass:host.ru:443/folder/file.php?a=123#test');
		$this->assertEquals($curl->unparse_url(), 'https://user@pass:host.ru:443/folder/file.php?a=123#test');
		unset($curl);
	}

	public function testGoogle() {
		$curl = new CurlGet('git remote add origin git@github.com:AKEB/CurlGet.git');
	}
}