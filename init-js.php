<?php

ini_set( 'display_errors', true );
define( 'START_TIME', microtime( true ) );

define( 'DIR', __DIR__. DIRECTORY_SEPARATOR );
require_once( DIR. 'jsminifier.php' );
require_once( DIR. 'minifier.php' );

$minifier = new MagmaMinifier\Minifier( DIR. 'tmp/', true );

$file = $minifier->js( [ DIR. 'js/jquery.js', DIR. 'js/main.js' ], 'v1' );

readfile( DIR. 'tmp/'. $file );

echo "\n". (microtime(true) - START_TIME). 'ms';