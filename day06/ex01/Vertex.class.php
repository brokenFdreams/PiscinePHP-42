<?php

require_once 'Color.class.php';

Class Vertex {

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	static $verbose = false;

	public function __construct( array $kwargs ) {
		$this->_x = $kwargs['x'];
		$this->_y = $kwargs['y'];
		$this->_z = $kwargs['z'];
		if ( isset( $kwargs['w'] ) )
			$this->_w = $kwargs['w'];
		else
			$this->_w = 1.0;
		if ( isset( $kwargs['color'] ) )
			$this->_color = $kwargs['color'];
		else
			$this->_color = new Color( array( 'red' => 255, 'green' => 255, 'blue' => 255 ) );
		if ( self::$verbose )
			echo $this->__toString() . ' constructed' . PHP_EOL;
		return;
	}

	public function __destruct() {
		if ( self::$verbose )
			echo $this->__toString() . ' destructed' . PHP_EOL;			
	}

	public function __toString() {
		if ( self::$verbose )
			return sprintf( 'Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f, %s )', $this->_x, $this->_y, $this->_z,
							$this->_w, $this->_color->__toString() );
		return sprintf( 'Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f )', $this->_x, $this->_y, $this->_z, $this->_w );
	}

	public function getX() {
		return $this->_x;
	}

	public function setX( $x ) {
		$this->_x = $x;
		return;
	}

	public function getY() {
		return $this->_y;
	}

	public function setY( $y ) {
		$this->_y = $y;
		return;
	}

	public function getZ() {
		return $this->_z;
	}

	public function setZ( $z ) {
		$this->_z = $z;
		return;
	}

	public function getW() {
		return $this->_w;
	}

	public function setW( $w ) {
		$this->_w = $w;
		return;
	}

	public function getColor() {
		return $this->_color;
	}

	public function setColor( $color ) {
		$this->color = $color;
		return;
	}

	public static function doc() {
		$file = fopen( "Vertex.doc.txt", 'r' );
		echo fread( $file, filesize( "Vertex.doc.txt" ) );
		fclose( $file );
		return;
	}
}

?>
