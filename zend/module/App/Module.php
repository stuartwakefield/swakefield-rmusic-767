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
        						( "controller" => "main"
        						, "action" => "home" ) ) ) ) )
      		, "controllers" => array
      			( "invokables" => array
      				( "main" => 'App\Controller\MainController' ) )
      		, "view_manager" => array
      			( "display_not_found_reason" => true
      			, "display_exceptions" => true
      			, "doctype" => "HTML5"
      			, "not_found_template" => "404"
      			, "exception_template" => "error"
      			, "template_map" => array
		        	( "layout/main" =>  __DIR__ . "/../../../app/layouts/main.phtml"
		        	, "home" => __DIR__ . "/../../../app/templates/home.phtml"
		        	, "result/item" => __DIR__ . "/../../../app/templates/result_item.phtml"
		        	, "result/list" => __DIR__ . "/../../../app/templates/result_list.phtml"
		        	, "search/form" => __DIR__ . "/../../../app/templates/search_form.phtml"
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
