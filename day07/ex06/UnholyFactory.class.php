<?php

class UnholyFactory {

	private $_fighters;

	public function __construct() {
		$this->_fighters = array();
	}

	public function absorb( $a ) {
		if ( $a instanceof Fighter ) {
			if ( isset( $this->_fighters[ $a->getName() ] ) )
				echo "(Factory already absorbed a fighter of type ". $a->getName() . ")" . PHP_EOL;
			else {
				$this->_fighters[ $a->getName() ] = $a;
				echo "(Factory absorbed a fighter of type " . $a->getName() . ")" . PHP_EOL;
			}
		} else
			echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
	}

	public function fabricate( $rf ) {
		if ( isset( $this->_fighters[ $rf ] ) ) {
			echo "(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL;
			return clone $this->_fighters[ $rf ];
		} else
			echo "(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL;
		return null;
	}

}

?>