<?php

class Jaime extends Lannister {

	public function sleepWith( $a ) {
		if ( $a instanceof Tyrion )
			echo "Not even if I'm drunk !" . PHP_EOL;
		else if ( $a instanceof Sansa )
			echo "Let's do this." . PHP_EOL;
		else if ( $a instanceof Cersei )
			echo "With pleasure, but only in a tower in Winterfell, then." . PHP_EOL;
	}

}

?>