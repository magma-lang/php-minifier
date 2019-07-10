<?php
/*
@package: Magma PHP Minifier for JS and CSS
@author: Sören Meier <info@s-me.ch>
@version: 0.1 <2019-07-05>
@docs: minifier.magma-lang.com/php/docs/
*/

namespace MagmaMinifier;

class Minifier {

	public $debug = false;

	protected $tmpPath = '';

	public function __construct( string $tmpPath, bool $debug = false ) {

		$this->tmpPath = $tmpPath;
		$this->debug = $debug;
		if ( !is_dir( $this->tmpPath ) )
			mkdir( $this->tmpPath );

	}

	// $v to change the filename for new versions
	// returns the relative path
	// to the tmp folder
	public function js( array $paths, string $v = '' ) {

		$k = md5( implode( $paths ). $v );
		$filename = $k. '.js';
		$outFile = $this->tmpPath. $filename;

		if ( is_file( $outFile ) && !$this->debug )
			return $filename;

		$str = '';
		foreach ( $paths as $p )
			$str .= file_get_contents( $p );

		$str = $this->minifyJs( $str );

		file_put_contents( $outFile, $str );

		return $filename;

	}

	public function minifyJs( string $str ) {

		$minifier = new JsMinifier;
		return $minifier->go( $str );

	}

	public function css( array $paths, string $v = '' ) {

		$k = md5( implode( $paths ). $v );
		$filename = $k. '.css';
		$outFile = $this->tmpPath. $filename;

		if ( is_file( $outFile ) && !$this->debug )
			return $filename;

		$str = '';
		foreach ( $paths as $p )
			$str .= file_get_contents( $p );

		$str = $this->minifyCss( $str );

		file_put_contents( $outFile, $str );

		return $filename;

	}

	public function minifyCss( string $str ) {

		$minifier = new CssMinifier;
		return $minifier->go( $str );

	}

	protected static function deleteDir( string $dir ) {

		foreach ( glob( $dir. '*', GLOB_MARK ) as $path )
			if ( is_file( $path ) )
				unlink( $path );
			else
				self::deleteDir( $path );

		rmdir( $dir );

	}

	public function cleanTmps() {
		self::deleteDir( $this->tmpPath );
	}

}