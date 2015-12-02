<?php 
namespace app\classes;
class main{

	// Main Controller

	private $cCsvArray = [];

	// Create the constructor for the web app. Page array & what page to load.
	public function __construct(){

		$page_request = 'app\classes\\' .'show';
		
		if(!empty($_REQUEST) && isset($_REQUEST['page'])){

			$page_request = 'app\classes\\' . $_REQUEST['page'];
			
		}

		$page = new $page_request();

		if($_SERVER['REQUEST_METHOD'] == "GET"){
			$page->get();
		}else{
			$page->post();
		}
		
	}

}
?>
