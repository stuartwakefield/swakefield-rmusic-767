<?php

/**
 * This class handles the home event
 */
class HomeHandler {
	
	private $homeView;
	private $searchFormView;
	private $mainLayout;

	/**
	 * Constructs the HomeHandler
	 * @param $homeView       the main template for the home page
	 * @param $searchFormView the template for the search form
	 * @param $mainLayout     the layout template
	 */
	function __construct($homeView, $searchFormView, $mainLayout) {
		$this->homeView = $homeView;
		$this->searchFormView = $searchFormView;
		$this->mainLayout = $mainLayout;
	}

	/**
	 * Handles the request for the home page
	 */
	function handle() {
		echo $this->mainLayout->render((object) array
			( "content" => $this->homeView->render((object) array
				( "searchForm" => $this->searchFormView->render() ))));
	}

}