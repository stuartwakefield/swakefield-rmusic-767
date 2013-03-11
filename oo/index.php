<?php
require_once "lib/Template.php";
require_once "views/SearchFormView.php";
require_once "handlers/HomeHandler.php";

$searchFormConfig = include __DIR__ . "/../app/config/search_form.php";
$searchFormContent = include __DIR__ . "/../app/content/search_form.php";

$mainLayoutTemplate = new Template(__DIR__ . "/../app/layouts/main.phtml");
$searchFormTemplate = new Template(__DIR__ . "/../app/templates/search_form.phtml");
$homeTemplate = new Template(__DIR__ . "/../app/templates/home.phtml");

$searchFormView = new SearchFormView($searchFormTemplate, $searchFormConfig, $searchFormContent);

$homeHandler = new HomeHandler($homeTemplate, $searchFormView, $mainLayoutTemplate);
$homeHandler->handle();
