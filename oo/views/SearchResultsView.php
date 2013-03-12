<?php
class SearchResultsView {
	
	private $template;
	private $itemView;

	function __construct($url, $arg, $template, $itemView) {
		$this->template = $template;
		$this->itemView = $itemView;
	}

	/**
	 * Calculates the pagination variables from the pagination data received
	 * from the searchextended client.
	 * @param $pagination the pagination data received
	 * @return            the calculated pagination data
	 */
	static function calculatePagination($pagination) {
		$page = $pagination->page;
		$pageSize = $pagination->per_page;
		$count = $pagination->total_count;
		$pageCount = ceil($count / $pageSize);
		$startIndex = ($page - 1) * $pageSize + 1;
		$endIndex = min($count, $startIndex + $pageSize - 1);
		$visibleCount = $endIndex - $startIndex;

		return (object) array
			( "page" => $page
			, "pageSize" => $pageSize
			, "pageCount" => $pageCount
			, "count" => $count
			, "startIndex" => $startIndex
			, "endIndex" => $endIndex
			, "visibleCount" => $visibleCount );
	}

	/**
	 * Creates the links for the pagination navigation
	 */
	static function createPageLink($search, $page, $pageSize) {
		return "{$this->url}?{$this->arg}={$search}&page={$page}&count={$pageSize}";
	}

	function render($args) {

		$pagination = self::calculatePagination($args->results->pagination);

		$records = $args->results->blocklist;

		// Workaround to pageSize bug (see README.md)
		if(count($records) !== $pagination->visibleCount) {
			array_splice($records, $pagination->visibleCount + 1);
		}

		$itemContent = array();
		foreach($records as $record) {
			$itemContent[] = $this->itemView->render($record);
		}

		if($pagination->startIndex > $pagination->count || $pagination->endIndex < 1) {
			die("No page");
		}

		$search = htmlspecialchars($_GET["search"]);
		
		$pages[] = (object) array
			( "name" => "first"
			, "number" => 1 );

		if($pagination->page > 1) {
			$pages[] = (object) array
				( "name" => "previous"
				, "number" => max(1, $pagination->page - 1) );
		}

		if($pagination->page < $pagination->pageCount) {
			$pages[] = (object) array
				( "name" => "next"
				, "number" => min($pagination->pageCount, $pagination->page + 1) );
		}

		$pages[] = (object) array
			( "name" => "last"
			, "number" => $pagination->pageCount );

		foreach($pages as $page) {
			$page->link = self::createPageLink($search, $page->number, $pagination->pageSize);
		}

		return $this->template->render((object) array
			( "pagination" => $pagination
			, "pages" => $pages
			, "items" => implode(" ", $itemContent) ));
	}

}