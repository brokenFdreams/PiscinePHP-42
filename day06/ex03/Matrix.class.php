<?php

require_once 'Vector.class.php'

Class Matrix {

	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "RX";
	const RY = "RY";
	const RZ = "RZ";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	protected $matrix;
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;
	static $verbose = false;

	public function __construct( array $kwargs = null ) {
		if ( isset( $kwargs ) ) {
			if ( isset( $kwargs['preset'] ) )
				$this->_preset = $kwargs['preset'];
			if ( isset( $kwargs['scale'] ) )
				$this->_scale = $kwargs['scale'];
			if ( isset( $kwargs['angle'] ) )
				$this->_angle = $kwargs['angle'];
			if ( isset( $kwargs['vtc'] ) )
				$this->_vtc = $kwargs['vtc'];
			if ( isset( $kwargs['fov'] ) )
				$this->_fov = $kwargs['fov'];
			if ( isset( $kwargs['ratio'] ) )
				$this->_ratio = $kwargs['ratio'];
			if ( isset( $kwargs['near'] ) )
				$this->_near = $kwargs['near'];
			if ( isset( $kwargs['far'] ) )
				$this->_far = $kwargs['far'];
			$this->_check();
			$this->_createMatrix();
			if ( self::$verbose )
				if ( $this->_prest == self::IDENTITY )
					echo "Matrix " . $this->_preset . " instance constructed" . PHP_EOL;
				else
					echo "Matrix " . $this->_preset . " preset instance constructed" . PHP_EOL;
			$this->_setting();
		}
		return;
	}

	private function _setting() {
		if ( $this->_preset == self::IDENTITY )
			$this->_scale(1);
		else if ( $this->_preset == self::SCALE )
			$this->_scale( $this->_scale );
		else if ( $this->_preset == self::TRANSLATION )
			$this->_translation();
		else if ( $this->_preset == self::RX )
			$this->_rotationX();
		else if ( $this->_preset == self::RY )
			$this->_rotationY();
		else if ( $this->_preset == self::RZ )
			$this->_rotationZ();
		else if ( $this->_preset == self::PROJECTION )
			$this->_projection();
	}

	public function mult( Matrix $rhs ) {
		$tmp = array();
		for ( $i = 0; $i < 4; $i++ )
			for ( $j = 0; $j < 4; $j++ )
				for( $g = 0; $g < 4; $g++ )
				$tmp[$i][$j] += $this->matrix[$i][$g] * $rhs->matrix[$g][$j];
		$matrix = new Matrix();
		$matrix->matrix = $tmp;
		return $matrix;
	}

	public function transformVertex( Vertex $vtx ) {
		$x = 0;
		$y = 0;
		$z = 0;
		$w = 0;
		for ( $i = 0; $i < 4; $i++ ) {
			if ( $i != 2 ) {
				$x += $this->matrix[0][$i];
				$y += $this->matrix[1][$i];
				$z += $this->matrix[2][$i];
				$w += $this->matrix[3][$i];
			}
		}
		return new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => $w ) );
	}

	private function _projection() {
		$this->matrix[0][0] = 1.30;
		$this->matrix[1][1] = 1.73;
		$this->matrix[2][2] = -0.96;
		$this->matrix[2][3] = -1.96;
		$this->matrix[3][2] = -1.00;
	}

	private function _rotationX() {
		$this->matrix[1][1] = cos( $this->_angle );
		$this->matrix[1][2] = -sin( $this->_angle );
		$this->matrix[2][1] = sin( $this->_angle );
		$this->matrix[2][2] = cos( $this->_angle );
		$this->matrix[0][0] = 1;
		$this->matrix[3][3] = 1;
	}

	private function _rotationY() {
        $this->matrix[0][0] = cos( $this->_angle );
		$this->matrix[2][0] = -sin( $this->_angle );
		$this->matrix[0][2] = sin( $this->_angle );
		$this->matrix[2][2] = cos( $this->_angle );
		$this->matrix[1][1] = 1;
		$this->matrix[3][3] = 1;
	}

	private function _rotationZ() {
		$this->matrix[0][0] = cos( $this->_angle );
		$this->matrix[0][1] = -sin( $this->_angle );
		$this->matrix[1][0] = sin( $this->_angle );
		$this->matrix[1][1] = cos( $this->_angle );
		$this->matrix[2][2] = 1;
		$this->matrix[3][3] = 1;
	}

	private function _translation() {
		$this->_scale( 1 );
		$this->matrix[0][3] = $this->_vtc->getX();
		$this->matrix[1][3] = $this->_vtc->getY();
		$this->matrix[2][3] = $this->_vtc->getZ();
	}

	private function _scale( $scale ) {
		$this->matrix[0][0] = $scale;
		$this->matrix[1][1] = $scale;
		$this->matrix[2][2] = $scale;
		$this->matrix[3][3] = 1;
	}

	private function _createMatrix() {
		for ( $i = 0; $i < 4; $i++ )
			for ( $j = 0; $j < 4; $j++ )
				$this->matrix[$i][$j] = 0;
		return;
	}

	public function __destruct() {
		if ( self::$verbose )
			echo "Matrix instance destructed" . PHP_EOL;
		return;
	}

	private function _check() {
		if ( empty( $this->_preset ))
			return "error";
		else if ( $this->_preset == self::SCALE && empty( $this->_scale ) )
			return "error";
		else if ( ( $this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ ) &&
				  empty( $this->_angle ) )
			return "error";
		else if ( $this->_preset == self::TRANSLATION && empty( $this->vtc ) )
			return "error";
		else if ( $this->_preset == self::PROJECTION &&
				  ( empty( $this->fov ) || empty( $this->_ratio ) || empty( $this->_near ) || empty( $this->_far ) ) )
			return "error";
		return;
	}

	public function __toString() {
		$tmp = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$tmp .= "-----------------------------\n";
		$tmp .= "x | %.2f | %.2f | %.2f | %.2f\n";
		$tmp .= "y | %.2f | %.2f | %.2f | %.2f\n";
		$tmp .= "z | %.2f | %.2f | %.2f | %.2f\n";
		$tmp .= "w | %.2f | %.2f | %.2f | %.2f";
		return sprintf( $tmp, $this->matrix[0][0], $this->matrix[0][1], $this->matrix[0][2], $this->matrix[0][3],
						$this->matrix[1][0], $this->matrix[1][1], $this->matrix[1][2], $this->matrix[1][3],
						$this->matrix[2][0], $this->matrix[2][1], $this->matrix[2][2], $this->matrix[2][3],
						$this->matrix[3][0], $this->matrix[3][1], $this->matrix[3][2], $this->matrix[3][3] );
	}

	public static function doc() {
		$file = fopen( "Matrix.doc.txt", 'r' );
		echo fread( $file, filesize( "Matrix.doc.txt" ) );
		fclose( $file );
		return;
	}
}

?>