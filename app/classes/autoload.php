<?php

class autoload{

	public static function load($class){

		$parts = explode('\\', $class);
		$file = '';
		$i = 0;
		foreach($parts as $key=>$value){
			if($key < count($parts) - 1){
				$file = $file . $value . '/';
			}else{
				$file = $file . $value . '.php';
			}
		}
		if(!file_exists($file)){
			return false;
		}
		include $file;

	}

}

?>
