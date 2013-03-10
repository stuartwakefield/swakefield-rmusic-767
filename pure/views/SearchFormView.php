<?php
class SearchFormView {
	
	private $template;
	private $config;
	private $content;

	function __construct($template, $form, $content) {
		$this->template = $template;
		$this->form = $form;
		$this->content = $content;
	}

	function render() {
		return $this->template->render((object) array
			( "form" => $this->form
			, "content" => $this->content ));
	}

}