<?php
require_once "TemplateContext.php";

class Template {
	
	private $page;

	function __construct($page) {
		$this->page = $page;
	}

	function render($args) {
		$context = new TemplateContext();
		foreach($args as $name => $value) {
			$context->$name = $value;
		}
		return $context->render($this->page);
	}

}