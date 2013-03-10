<?php
require_once "CurlSearchExtendedEndpoint.php";

$endpoint = new CurlSearchExtendedEndpoint("http://www.bbc.co.uk/iplayer/ion/searchextended/");
$data = $endpoint->request("search_availability/iplayer/q/chris/format/json");
