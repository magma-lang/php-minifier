# A Minifier for CSS and JS in PHP

## Usage

```
require_once( __DIR__. '/cssminifier.php' );
require_once( __DIR__. '/jsminifier.php' );
require_once( __DIR__. '/minifier.php' );

$minifier = new MagmaMinifier\Minifier( __DIR__. '/tmp/', true );

// JS
$file = $minifier->js( [ __DIR__. '/js/jquery.js', __DIR__. '/js/main.js' ], 'v1' );
$absoluteFilePath = __DIR__. '/tmp/'. $file;

// CSS
$file = $minifier->css( [ __DIR__. '/css/bootstrap.css', __DIR__. '/css/style.css' ], 'v1' );
$absoluteFilePath = __DIR__. '/tmp/'. $file;
```
