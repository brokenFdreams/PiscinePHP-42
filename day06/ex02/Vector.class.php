<?php

require_once 'Vertex.class.php';

Class Vector {

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	static $verbose = false;

	public function __construct( array $kwargs ) {
		if ( isset( $kwargs['dest'] ) && $kwargs['dest'] instanceof Vertex ) {
			if ( isset( $kwargs['orig'] ) && $kwargs['orig'] instanceof Vertex )
				$orig = new Vertex( array( 'x' => $kwargs['orig']->getX(), 'y' => $kwargs['orig']->getY(), 'z' => $kwargs['orig']->getZ() ) );
			else
				$orig = new Vertex( array( 'x' => 0, 'y' => 0, 'z' => 0 ) );
			$this->_x = $kwargs['dest']->getX() - $orig->getX();
			$this->_y = $kwargs['dest']->getY() - $orig->getY();
			$this->_z = $kwargs['dest']->getZ() - $orig->getZ();
			$this->_w = 0;
		}
		if ( self::$verbose )
			echo $this->__toString() . ' constructed' . PHP_EOL;
	}

	public function magnitude() {
		return sqrt( ( $this->_x * $this->_x ) + ( $this->_y * $this->_y ) + ( $this->_z * $this->_z ) );
	}

	public function normalize() {
		$magnitude = $this->magnitude();
		return new Vector( array( 'dest' => new Vertex( array( 'x' => $this->_x / $magnitude,
															   'y' => $this->_y / $magnitude,
															   'z' => $this->_z / $magnitude ) ) ) );
	}

	public function add( Vector $rhs ) {
		return new Vector( array( 'dest' => new Vertex( array( 'x' => $this->_x + $rhs->getX(),
															   'y' => $this->_y + $rhs->getY(),
															   'z' => $this->_z + $rhs->getZ() ) ) ) );
	}

	public function sub( Vector $rhs ) {
		return new Vector( array( 'dest' => new Vertex( array( 'x' => $this->_x - $rhs->getX(),
															   'y' => $this->_y - $rhs->getY(),
															   'z' => $this->_z - $rhs->getZ() ) ) ) );
	}

	public function opposite() {
		return new Vector( array( 'dest' => new Vertex( array( 'x' => -$this->_x,
															   'y' => -$this->_y,
															   'z' => -$this->_z ) ) ) );
	}

	public function scalarProduct ( $k ) {
		return new Vector( array( 'dest' => new Vertex( array( 'x' => $this->_x * $k,
															   'y' => $this->_y * $k,
															   'z' => $this->_z * $k ) ) ) );
	}

	public function dotProduct( Vector $rhs ) {
		return ( $this->_x * $rhs->getX() ) + ( $this->_y * $rhs->getY() ) + ( $this->_z * $rhs->getZ() );
	}

	public function cos( Vector $rhs ) {
		return $this->dotProduct( $rhs ) / ( $this->magnitude() * $rhs->magnitude() );
	}

	public function crossProduct( Vector $rhs ) {
		return new Vector( array( 'dest' => new Vertex( array( 'x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
															   'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
															   'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX() ) ) ) );
	}

	public function __destruct() {
		if ( self::$verbose )
			echo $this->__toString() . ' destructed' . PHP_EOL;
	}

	public function __toString() {
		return sprintf('Vertex( x:%.2f, y:%.2f, z:%.2f, w:%.2f )', $this->_x, $this->_y, $this->_z, $this->_w );
	}

	public static function doc() {
		$file = fopen( "Vector.doc.txt", 'r' );
		echo fread( $file, filesize( 'Vector.doc.txt' ) );
		fclose( $file );
		return;
	}

	public function getX() {
		return $this->_x;
	}

	public function getY() {
		return $this->_y;
	}

	public function getZ() {
		return $this->_z;
	}

	public function getW() {
		return $this->_w;
	}

}

?>