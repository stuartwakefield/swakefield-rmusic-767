<?php
class HomeHandler {
	
	private $homeView;
	private $searchFormView;

	function __construct($homeView, $searchFormView, $mainLayout) {
		$this->homeView = $homeView;
		$this->searchFormView = $searchFormView;
		$this->mainLayout = $mainLayout;
	}

	function handle() {
		echo $this->mainLayout->render((object) array
			( "content" => $this->homeView->render((object) array
				( "searchForm" => $this->searchFormView->render() ))));
	}

}