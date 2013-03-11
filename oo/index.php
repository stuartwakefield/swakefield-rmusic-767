<?php
require_once "lib/Template.php";
require_once "views/SearchFormView.php";
require_once "handlers/HomeHandler.php";

$searchFormConfig = (object) array
	( "url" => "search"
	, "arg" => "search" );
$searchFormContent = (object) array
	( "label" => "Search"
	, "placeholder" => "Enter your search..."
	, "button" => "Go" );

$mainLayoutTemplate = new Template("layouts/main.phtml");
$searchFormTemplate = new Template("templates/search_form.phtml");
$homeTemplate = new Template("templates/home.phtml");

$searchFormView = new SearchFormView($searchFormTemplate, $searchFormConfig, $searchFormContent);

$homeHandler = new HomeHandler($homeTemplate, $searchFormView, $mainLayoutTemplate);
$homeHandler->handle();
