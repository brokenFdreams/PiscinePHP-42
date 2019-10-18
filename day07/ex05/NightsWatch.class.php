<?php

class NightsWatch {

	private $_watchers;

	public function __construct() {
		$this->_watchers = array();
	}

	public function recruit( $a ) {
		$this->_watchers[] = $a;
	}

	public function fight() {
		foreach ( $this->_watchers as $watcher )
			if ( $watcher instanceof IFighter )
				$watcher->fight();
	}
}

?>