<?php
require_once realpath(dirname(__FILE__) . "/../../lib/searchextended/SearchExtendedClient.php");

/**
 * This is a spy used to ensure that the client is passing the
 * correct details to the endpoint. The endpoint creates the
 * actual HTTP request. This provides a way of testing the
 * client without producing HTTP requests.
 */
class MockSearchExtendedEndpoint {

	public $params;

	function request($path) {
		$this->path = $path;

		/* As it doesn't matter in which order the parameters are
		 * passed and the ordering of the parameters cannot be 
		 * guaranteed, parse the path into an associative array for 
		 * assertion */
		$params = array();
		$items = explode("/", $path);
		$count = count($items);
		for($index = 0; $index < $count; $index += 2) {
			$params[$items[$index]] = $items[$index + 1];
		}
		$this->params = $params;
	}

}

class SearchExtendedClientTestCase extends PHPUnit_Framework_TestCase {

	private $endpoint;	
	private $client;

	function setUp() {
		$this->endpoint = new MockSearchExtendedEndpoint();
		$this->client = new SearchExtendedClient($this->endpoint);
	}

	function testRequest() {

		$this->client->request(array
			( "search_availability" => "any"
			, "q" => "something" ));

		// Check that the endpoint received the parameters
		$this->assertEquals(array
			( "search_availability" => "any"
			, "q" => "something" ), $this->endpoint->params);
	}

}