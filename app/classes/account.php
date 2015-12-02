<?php namespace app\classes;
class account{

	// Creating life
	public static function make($index, $first, $last, $email){
		return new person($index, $first, $last, $email);
	}

}
?>
