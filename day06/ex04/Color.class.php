<?php

Class Color {

	public $red;
	public $green;
	public $blue;
	public static $verbose = false;

	public function __construct( array $kwargs ) {
		if ( array_key_exists( 'red', $kwargs ) &&
			 array_key_exists( 'green', $kwargs ) &&
			 array_key_exists( 'blue', $kwargs ) ) {
			$this->red = intval( $kwargs['red'] );
			$this->green = intval( $kwargs['green'] );
			$this->blue = intval( $kwargs['blue'] );
		} else if ( array_key_exists ( 'rgb', $kwargs ) ) {
			$rgb = intval( $kwargs['rgb'] );
			$this->red = $rgb / 65536 % 256;
			$this->green = $rgb / 256 % 256;
			$this->blue = $rgb % 256;			
		}
		if ( self::$verbose )
			echo $this->__toString() . ' constructed.' . PHP_EOL;
		return;
	}

	public function __destruct() {
		if ( self::$verbose )
			echo $this->__toString() . ' destructed.' . PHP_EOL;
		return;
	}
	
	public function __toString() {
		return sprintf( 'Color( red: %3d, green: %3d, blue: %3d )', $this->red,  $this->green, $this->blue );
	}

	public function add( $color ) {
		return ( new Color( array( 'red' => $this->red + $color->red, 'green' => $this->green + $color->green, 'blue' => $this->blue + $color->blue ) ) );
	}

	public function sub( $color ) {
		return ( new Color( array( 'red' => $this->red - $color->red, 'green' => $this->green - $color->green, 'blue' => $this->blue - $color->blue ) ) );
	}

	public function mult( $mult ) {
		return ( new Color( array( 'red' => $this->red * $mult, 'green' => $this->green * $mult, 'blue' => $this->blue * $mult ) ) );
	}

	public static function doc() {
		$file = fopen( "Color.doc.txt", 'r' );
		echo fread( $file, filesize("Color.doc.txt" ) );
		fclose( $file );
		return;
	}

}

?>
