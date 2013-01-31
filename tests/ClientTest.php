<?php

use Blimp\Client;

class ClientTest extends PHPUnit_Framework_TestCase {
	public function test_construct () {
		$username = '';
		$api_key = '';
		$app_id = '';
		$app_secret = '';

		$client = new Client ($username, $api_key, $app_id, $app_secret);
		$this->assertEquals ('Blimp\Client', get_class ($client));
	}
}