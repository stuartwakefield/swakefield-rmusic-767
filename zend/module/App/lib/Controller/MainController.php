<?php
namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController
  , Zend\View\Model\ViewModel;

class MainController extends AbstractActionController {
	
    public function homeAction() {
    	
    	$layout = $this->layout();
		$layout->setTemplate("layout/main");
		
		$view = new ViewModel();
		$view->setTemplate("home");
		
		$searchFormView = new ViewModel(array
			( "form" => include __DIR__ . "/../../../../../app/config/search_form.php"
			, "content" => include __DIR__ . "/../../../../../app/content/search_form.php" ));
		$searchFormView->setTemplate("search/form");
		
		$view->addChild($searchFormView, "searchForm");
		
		return $view;
		
    }
	
	public function searchAction() {
		
	}
	
}
