<?php
class Template {
	
	private $page;

	function __construct($page) {
		$this->page = $page;
	}

	function render($args) {
		ob_start();
		include $this->page;
		return ob_get_clean();
	}

}