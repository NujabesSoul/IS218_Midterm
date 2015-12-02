<?php namespace app\classes;
class front extends template{

	//	Creates the web application based on information
	//	obtained via method=GET
	
	public function get(){
		$this->createHeader();
		$this->createBody('get');
		$this->createFooter();
	}

	//	Creates the web application based on information
	//	obtained via method=POST

	public function post(){
		$this->createHeader();
		$this->createBody('post');
		$this->createFooter();
	}


	//	Creates the page container

	public function createBody($type){
		echo "'<h1>Welcome to Erick Allas's Record Keeper!</h1><hr>'";
		echo '<form method='. $type .'>';
		echo '	<button type="submit" name="page" value="show" class="btn btn-default btn-lg">Show Data</button>';
		echo '	<button type="submit" name="page" value="add" class="btn btn-success btn-lg">Add Entry</button>';
		echo '</form>';
	}



}
	
?>
