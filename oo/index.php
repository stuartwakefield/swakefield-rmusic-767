<?php
require_once "lib/Template.php";
require_once "views/SearchFormView.php";
require_once "handlers/HomeHandler.php";

// Collect the configuration and content for the request
$searchFormConfig = include "../app/config/search_form.php";
$searchFormContent = include "../app/content/search_form.php";

// Collect the templates to be used
$mainLayoutTemplate = new Template("../app/layouts/main.phtml");
$searchFormTemplate = new Template("../app/templates/search_form.phtml");
$homeTemplate = new Template("../app/templates/home.phtml");

// Construct the search form view with the config, content and template
$searchFormView = new SearchFormView($searchFormTemplate, $searchFormConfig, $searchFormContent);

// Construct the handler with the views
$homeHandler = new HomeHandler($homeTemplate, $searchFormView, $mainLayoutTemplate);

// Handle the request
$homeHandler->handle();
