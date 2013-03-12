<?php
$lib = array
	( "lib/jquery/jquery.min.js"
	, "lib/underscore/underscore.min.js"
	, "lib/backbone/backbone.min.js" );

$src = array
	( "src/views/episodes.js"
	, "src/views/brands.js"
	, "src/views/search.js"
	, "src/views/app.js"
	, "src/app.js" );
	
$files = array_merge($lib, $src);

header("Content-Type: application/javascript");
foreach($files as $file) {
	echo file_get_contents($file);
}
