<?php
namespace App;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {
	
    public function onBootstrap(MvcEvent $event) {
        $eventManager = $event->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return array
        	( "router" => array
        		( "routes" => array
        			( "home" => array
        				( "type" => 'Zend\Mvc\Router\Http\Literal'
        				, "options" => array
        					( "route"    => "/"
        					, "defaults" => array
        						( "controller" => "home"
        						, "action" => "home" ) ) ) ) )
      		, "controllers" => array
      			( "invokables" => array
      				( "home" => 'App\Controller\HomeController' ) )
      		, "view_manager" => array
      			( "display_not_found_reason" => true
      			, "display_exceptions" => true
      			, "doctype" => "HTML5"
      			, "not_found_template" => "404"
      			, "exception_template" => "error"
      			, "template_map" => array
		        	( "layout/layout" => __DIR__ . "/view/layout/main.phtml"
		        	, "app/home/home" => __DIR__ . "/view/home.phtml"
		        	, "error/404" => __DIR__ . "/view/404.phtml"
		        	, "error/error" => __DIR__ . "/view/error.phtml" )
		        , "template_path_stack" => array
		        	( __DIR__ . "/view" ) ) );
    }

    public function getAutoloaderConfig() {
        return array
        	( 'Zend\Loader\StandardAutoloader' => array
            	( "namespaces" => array
            		( __NAMESPACE__ => __DIR__ . "/lib/" ) ) );
    }
	
}
