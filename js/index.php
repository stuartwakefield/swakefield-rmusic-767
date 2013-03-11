<?php
$lib = array
	( "lib/jquery/jquery.min.js"
	, "lib/underscore/underscore.min.js"
	, "lib/backbone/backbone.min.js" );

$src = array
	( "src/collections/brand.js"
	, "src/models/brand.js"
	, "src/views/brand_list.js"
	, "src/views/search_form.js"
	, "src/views/app.js"
	, "src/app.js" );
	
$files = array_merge($lib, $src);

header("Content-Type: application/javascript");
foreach($files as $file) {
	echo file_get_contents($file);
}
