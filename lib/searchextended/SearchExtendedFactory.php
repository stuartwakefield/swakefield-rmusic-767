<?php
require_once "SearchExtendedClient.php";
require_once "CurlSearchExtendedEndpoint.php";

class SearchExtendedFactory {
	
	function createClient() {
		return new SearchExtendedClient(new CurlSearchExtendedEndpoint(SearchExtendedClient::ENDPOINT_URL));
	}

}