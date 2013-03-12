<?php
require_once "../lib/searchextended/SearchExtendedFactory.php";
require_once "lib/Template.php";
require_once "views/SearchResultsItemView.php";
require_once "views/SearchResultsView.php";
require_once "handlers/SearchHandler.php";

$searchExtendedFactory = new SearchExtendedFactory();
$searchExtendedClient = $searchExtendedFactory->createClient();

$mainLayoutTemplate = new Template("../app/layouts/main.phtml");
$searchResultItemTemplate = new Template("../app/templates/result_item.phtml");
$searchResultListTemplate = new Template("../app/templates/results_list.phtml");

$searchResultsItemView = new SearchResultsItemView($searchResultItemTemplate);
$searchResultsView = new SearchResultsView($searchResultListTemplate, $searchResultsItemView);

$searchHandler = new SearchHandler($searchExtendedClient, $searchResultsView, $mainLayoutTemplate);
$searchHandler->handle();