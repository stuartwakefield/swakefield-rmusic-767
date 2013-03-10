<?php
class SearchResultsItemView {
	
	private $template;

	function __construct($template) {
		$this->template = $template;
	}

	function render($args) {
		return $this->template->render($args);
	}

}