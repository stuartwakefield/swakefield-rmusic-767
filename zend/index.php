<?php
require_once "vendor/autoload.php";

Zend\Mvc\Application::init(array
    ( 'modules' => array
    	( 'App' )
    , 'module_listener_options' => array
    	( 'module_paths' => array
    		( './module'
    		, './vendor' ) ) ) )->run();
