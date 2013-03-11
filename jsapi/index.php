<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";
require_once "../lib/searchextended/SearchExtendedFactory.php";

$app = new \Slim\Slim();

$app->get("/suggest/:search", function($search) use($app) {
	
	$factory = new SearchExtendedFactory();
	$client = $factory->createClient();
	
	$res = $app->response();
	
	$data = $client->request(array
		( "q" => $search
		, "search_availability" => "iplayer"
		, "perpage" => 10 ));
	
	$ids = array();
	$brands = array();
	
	foreach($data->blocklist as $record) {
		if(!isset($ids[$record->brand_id])) {
			$ids[$record->brand_id] = true;
			$brands[] = (object) array
				( "title" => $record->brand_title
				, "id" => $record->brand_id
				, "masterbrand" => $record->masterbrand
				, "masterbrand_title" => $record->masterbrand_title );	
		}
	}
	
	$res["Content-Type"] = "application/json";
	
	echo json_encode($brands);

});

$app->get("/search/:search", function($search) use($app) {
	
	$factory = new SearchExtendedFactory();
	$client = $factory->createClient();
	
	$res = $app->response();
	
	$res["Content-Type"] = "application/json";
	
	echo json_encode($client->request(array
		( "q" => $search
		, "search_availability" => "iplayer"
		, "perpage" => 10 )));
		
});

$app->run();
