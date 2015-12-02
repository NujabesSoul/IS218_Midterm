<?php namespace app\classes;
class add extends template{

	//  Creates the web application based on information
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

	// Creating the body.
	
	public function createBody($type){
		echo '<h1>Add Data</h1>';
		echo '<hr>';
		if((isset($_REQUEST['first']) && $_REQUEST['first'] != '') && (isset($_REQUEST['last']) && $_REQUEST['last'] != '') && (isset($_REQUEST['email']) || $_REQUEST['email'] != '')){
			echo '<h5>Successfully added the record!</h5>';
			$argArray = array($_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email']);
			$this->writeCSV($this->getCSVFile(), $argArray);		
		}
		$this->makeForm($type);

	}

	public function makeForm($type){
		echo '<form method="'. $type .'">';
		echo ' 	First Name<input class="form-control" type="text" name="first" required><br/>';
		echo '	Last Name<input class="form-control" type="text" name="last" required></br>';
		echo '	Email<input class="form-control" type="text" name="email" required></br>';
		echo ' 	<button type="submit" value="add" name="page" class="btn btn-success">Add Record</button>';
		echo '<hr>';
		echo '</form></br>';
		echo '<form method="'. $type .'">';
		echo '<button type="submit" value="show" name="page" class="btn btn-danger">Back to Records</button>';
		echo '</form>';
	}
}
	
?>
