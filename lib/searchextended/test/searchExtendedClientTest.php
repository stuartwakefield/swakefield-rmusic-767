<?php
require_once realpath(__DIR__ . "/../SearchExtendedClient.php");

/**
 * This is a spy used to ensure that the client is passing the
 * correct details to the endpoint. The endpoint creates the
 * actual HTTP request. This provides a way of testing the
 * client without producing HTTP requests.
 */
class MockSearchExtendedEndpoint {

	public $params;

	/**
	 * This request method is called by the client to invoke a
	 * HTTP request, in this case the mock intercepts the request and
	 * parses it into an array.
	 * @param $path the request path the client sends 
	 */
	function request($path) {
		$this->path = $path;

		/* It doesn't matter in which order the parameters are
		 * passed and as the ordering of the parameters cannot be 
		 * guaranteed parse the path into an associative array for 
		 * assertion */
		$params = array();
		$items = explode("/", $path);
		$count = count($items);
		
		// Loop through the pairs
		for($index = 0; $index < $count; $index += 2) {
			$params[$items[$index]] = $items[$index + 1];
		}
		
		// Expose the parsed parameters
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

	function testFormatParameterSent() {

		$this->client->request(array());

		// Check that the endpoint received the parameters 
		$this->assertEquals(array
			( "format" => "json" ), $this->endpoint->params);
	}

}