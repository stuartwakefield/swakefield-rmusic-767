<?php
class SearchResultsView {
	
	private $template;
	private $itemView;

	function __construct($template, $itemView) {
		$this->template = $template;
		$this->itemView = $itemView;
	}

	function render($args) {

		$page = $args->results->pagination->page;
		$pageSize = $args->results->pagination->per_page;
		$count = $args->results->pagination->total_count;
		
		$pageCount = ceil($count / $pageSize);
		
		$startIndex = ($page - 1) * $pageSize + 1;
		$endIndex = min($count, $startIndex + $pageSize - 1);
		$visibleCount = $endIndex - $startIndex;
		
		$records = $args->results->blocklist;

		// Workaround to pageSize bug (see README.md)
		if(count($records) !== $visibleCount) {
			array_splice($records, $visibleCount + 1);
		}

		$itemContent = array();
		foreach($records as $record) {
			$itemContent[] = $this->itemView->render($record);
		}

		if($startIndex > $count || $endIndex < 1) {
			die("No page");
		}

		$search = htmlspecialchars($_GET["search"]);
		
		$hasNextPage = $page < $pageCount;
		$hasPreviousPage = $page > 1;

		$firstPage = (object) array
			( "number" => 1 );
		$firstPage->link = "/search?search={$search}&page={$firstPage->number}&count={$pageSize}";

		$lastPage = (object) array
			( "number" => $pageCount );
		$lastPage->link = "/search?search={$search}&page={$lastPage->number}&count={$pageSize}";

		$nextPage = false;
		if($hasNextPage) {
			$nextPage = (object) array
				( "number" => max(1, $page + 1) );
			$nextPage->link = "/search?search={$search}&page={$nextPage->number}&count={$pageSize}";
		}

		$previousPage = false;
		if($hasPreviousPage) {
			$previousPage = (object) array
				( "number" => min($pageCount, $page - 1) );
			$previousPage->link =  "/search?search={$search}&page={$previousPage->number}&count={$pageSize}";
		}

		return $this->template->render((object) array
			( "page" => $page
			, "pageSize" => $pageSize
			, "startIndex" => $startIndex
			, "endIndex" => $endIndex
			, "pageCount" => $pageCount
			, "visibleCount" => $visibleCount
			, "count" => $count
			, "hasPreviousPage" => $hasPreviousPage
			, "previousPage" => $previousPage
			, "hasNextPage" => $hasNextPage
			, "nextPage" => $nextPage
			, "firstPage" => $firstPage
			, "lastPage" => $lastPage
			, "items" => implode(" ", $itemContent) ));
	}

}