<?php namespace app\classes;
class show extends template{

	// Get
	public function get(){
		$this->createHeader();
		$this->createBody('get');
		$this->createFooter();
	}

	// Post
	public function post(){
		$this->createHeader();
		$this->createBody('post');
		$this->createFooter();
	}

	// Body
	public function createBody($type){
		echo '<h1>IS218 Data Records</h1>';
		echo '<hr>';
		$csvArray = $this->readCSV($this->getCSVFile());
		foreach($csvArray as $row => $account){
			$person = account::make($account[0],$account[1],$account[2],$account[3]);
			print_r($person->setOpenButton());
			unset($person);
		}
		$this->makeForm($type);
	}
	public function makeForm($type){
		echo '<h5>Would you like to add an entry?</h5>';
		echo '<form method="'. $type .'">';
		echo '	<button type="submit" name="page" value="add" class="btn btn-success btn-lg">Add Entry</button>';
		echo '</form>';
	}

}
	
?>
