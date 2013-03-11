<?php
class SearchHandler {
	
	private $searchExtendedClient;
	private $resultsView;
	private $mainLayout;

	function __construct($searchExtendedClient, $resultsView, $mainLayout) {
		$this->searchExtendedClient = $searchExtendedClient;
		$this->resultsView = $resultsView;
		$this->mainLayout = $mainLayout;
	}

	function handle() {

		if(!isset($_GET["search"])) {

		} else {

			$page = 1;
			$perpage = 10;

			if(isset($_GET["page"])) {
				$page = $_GET["page"];
			} 
			if(isset($_GET["count"])) {
				$perpage = $_GET["count"];
			}

			$results = $this->searchExtendedClient->request(array
				( "search_availability" => "iplayer"
				, "q" => $_GET["search"]
				, "page" => $page 
				, "perpage" => $perpage ));

			echo $this->mainLayout->render((object) array
				( "content" => $this->resultsView->render((object) array
					( "results" => $results ))));
		}

	}

}