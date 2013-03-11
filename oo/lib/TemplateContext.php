<?php
class TemplateContext {
	
	function render($page) {
		ob_start();
		include $page;
		return ob_get_clean();
	}
	
}
