<?php
require_once "SearchExtendedException.php";

class CurlSearchExtendedEndpoint {
	
	private $url;

	function __construct($url) {

		// Url example: http://www.bbc.co.uk/iplayer/ion/searchextended/
		$this->url = $url;
	}

	function request($path) {
		
		// Need to ensure there is a single slash between this url and path
		$ch = curl_init($this->url . $path);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$res = curl_exec($ch);
		$info = curl_getinfo($ch);

		if($info["http_code"] !== 200) {
			throw new SearchExtendedException("The end point did not respond successfully");
		}

		if($info["content_type"] !== "application/json") {
			throw new SearchExtendedException("The response from the end point was not JSON");
		}

		return json_decode($res);
	}

}