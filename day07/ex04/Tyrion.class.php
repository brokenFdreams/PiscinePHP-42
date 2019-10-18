<?php

class Tyrion extends Lannister {

	public function sleepWith( $a ) {
		if ( $a instanceof Lannister )
			echo "Not even if I'm drunk !" . PHP_EOL;
		else if ( $a instanceof Sansa )
			echo "Let's do this." . PHP_EOL;
	}

}

?>