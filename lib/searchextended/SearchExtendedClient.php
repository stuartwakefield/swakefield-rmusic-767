<?php
class SearchExtendedClient {
	
	const ENDPOINT_URL = "http://www.bbc.co.uk/iplayer/ion/searchextended/";
	private $endpoint;

	/**
	 * @param
	 */
	function __construct($endpoint) {
		$this->endpoint = $endpoint;
	}

	/**
	 * @param $args
	 */
	function request($args) {
		$pairs = array("format/json");
		foreach($args as $key => $value) {

			// Ignore the format specifier must be in JSON
			if(strcasecmp($key, "format") !== 0) {
				$pairs[] = urlencode($key) . "/" . urlencode($value);
			}
		}
		return $this->endpoint->request(implode("/", $pairs));
	}

}