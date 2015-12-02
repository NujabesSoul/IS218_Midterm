<?php 

namespace app\classes;

class person{

	private $index;
	private $first;
	private $last;
	private $email;

	public function __construct($index, $first, $last, $email){

		$this->index = $index;
		$this->first = $first;
		$this->last = $last;
		$this->email = $email;

	}
	public function setOpenButton(){
		echo '<form method="post">';
		echo '<input type="hidden" value="' . $this->index . '" name="index">';
		echo '<input type="hidden" value="true" name="update">';
		echo '<div class="col-md-3"> First Name: ' . $this->first . '</div>';
		echo '<div class="col-md-3"> Last Name: ' . $this->last . '</div>';
		echo '<div class="col-md-3"> Email: ' . $this->email . '</div>';
		echo '<button type="submit" name="page" value="update" class="btn btn-warning btn-xs">Edit</button>';
		echo '</form>';
		echo '<hr>';
	}
	public function getFirst(){
		return $this->first;
	}
	public function getLast(){
		return $this->last;
	}
	public function getEmail(){
		return $this->email;
	}

}

?>
