<?php 
namespace app\classes;
	
class update extends template{

	private $index;
	private $first;
	private $last;
	private $email;

	// Overrides template's post function
	public function get(){
		$this->createHeader();
		$this->createBody('get');
		$this->createFooter();
	}

	// Overrides template's post function

	public function post(){
		$this->createHeader();
		$this->createBody('post');
		$this->createFooter();
	}

	public function createBody($type){
		if(isset($_REQUEST['index'])){
			echo '<h1>Update Data</h1> <hr>';
			$this->index = $_REQUEST['index'];
			$csvArray = $this->readCSV($this->getCSVFile());
			$i = 0;
			foreach($csvArray as $row=>$next){
				$i += 1;
			}
			if($i < $this->index){
				echo "It's not working, try again!";
				$this->showFail();
			}else if(isset($_REQUEST['update']) && $_REQUEST['update'] == 'true'){
				foreach($csvArray as $row=>$next){
					if($next[0] == $this->index){
						$this->first = $next[1];
						$this->last = $next[2];
						$this->email = $next[3];
					}
				}
				$this->makeForm($this->first, $this->last, $this->email, $type);
			}else{
				echo "Still ain't working yet!";
				$this->showFail();
			}
		}else if((isset($_REQUEST['first']) && isset($_REQUEST['last']) && isset($_REQUEST['email'])) && (isset($_REQUEST['update']) && $_REQUEST['update'] == 'true')){
			echo '<h1">Update Data</h1> <hr>';
			if(isset($_REQUEST['index'])){
				$locArray = array($_REQUEST['index'], $_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email']);
				$this->updateCSV($this->getCSVFile(), $locArray);
				$this->makeForm($_REQUEST['first'], $_REQUEST['last'], $_REQUEST['email']);
			}
		}else if(isset($_REQUEST['delete']) && $_REQUEST['delete'] == 'true' && isset($_REQUEST['index']) && $_REQUEST['index'] >= 0){
			echo '<h1>Delete Data</h1><hr>';
			$this->index = $_REQUEST['index'];
			$this->deleteCSV($this->getCSVFile(), $this->index);
			$this->showDelete($type);
		}else{
			echo '<h1>Update Data</h1><hr>';
			echo "It's not working, try again!";
			$this->showFail();
		}
	}

	public function makeForm($first, $last, $email, $type){
		echo 'First Name: ' . $first . '</br>';
		echo 'Last Name: ' . $last . '</br>';
		echo 'Email: ' . $email . '</br></br>';
		echo '<form method="' . $type .'">';
		echo ' 	<input type="hidden" name="index" value="' . $_REQUEST['index'] . '">';
		echo ' 	First Name <input class="form-control" type="text" name="first" required><br/>';
		echo '	Last Name <input class="form-control" type="text" name="last" required></br>';
		echo '	Email <input class="form-control" type="text" name="email" required></br><br>';
		echo ' 	<input type="submit" name="update" class="btn btn-warning" value="Update">';
		// echo ' 	<button type="submit" value="update" name="page" class="btn btn-warning"></button>';
		echo '</form></br><hr>';
		echo '<form method="post">';
		echo ' 	<button type="submit" value="show" name="page" class="btn btn-success">Back to Records</button>';
		echo '</form></br>';
		echo '<form method="post">';
		echo '	<input type="hidden" name="index" value="' . $_REQUEST['index'] . '">';
		echo '	<input type="hidden" name="delete" value="true">';
		echo ' 	<button type="submit" value="update" name="page" class="btn btn-danger">Delete Record</button>';
		echo '</form>';
	}

	public function showDelete($type){
		echo 'item deleted';
		echo '<form method="' . $type .'">';
		echo ' 	<button type="submit" value="add" name="page">Add Records</button>';
		echo '	<button type="submit" value="show" name="page">Check Results</button>';
		echo '</form></br>';
	}

	public function showFail(){
		echo '<form method="GET">';
		echo ' 	<button type="submit" value="show" name="page" class="btn btn-danger btn-lg">Back to Main Menu</button>';
		echo '</form>';
	}
	

}
	
?>
