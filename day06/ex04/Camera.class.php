<?php

Class Camera {

	private $_tT;
	private $_tR;
	private $_proj;
	private $_origin;
	private $_orientation;
	private $_width;
	private $_height;
	static $verbose = false;

	public function __construct( array $kwargs ) {
		
		if ( self::$verbose )
			echo "Camera instance constructed" . PHP_EOL;
	}

	public function __destruct() {
		if ( self::$verbose )
			echo "Camera instance destructed" . PHP_EOL;
	}

	public function __toString() {
		return;
	}

	public static function doc() {
		$file = fopen( "Camera.doc.txt", 'r' );
		echo $fread( $file, filesize( "Camera.doc.txt", 'r' ) );
		fclose( $file );
		return;
	}

}

?>