<?php 

namespace app\classes;

abstract class template{

	private $csv = 'files/records.csv';

	// Template for each page.

	public function get(){}

	public function post(){}

	public function createBody($type){}

	public function createHeader(){}

	public function createFooter(){}
	
	// Read CSV
	public function readCSV($file){
		$locArray = array();
		$i = 0;
		if(!file_exists($file)){
			$this->createCSV('records');
			$file = $this->getCSVFile();
		}
		$locHandle = fopen($file, 'r');
		while(($row = fgetcsv($locHandle, 1024)) !== false){
			foreach($row as $k=> $value){
				$locArray[$i][$k] = $value;
			}
			$i++;
		}
		fclose($locHandle);
		return $locArray;
	}
	
	// Create CSB+V
	public static function createCSV($fileName){
		$file = fopen('files/' . $fileName .'.csv', 'w');
		fputcsv($file, $locArray);
		fclose($file);
	}

	// Write CSV
	public function writeCSV($file, $array){
		$tempFile = fopen('files/temp.csv', 'a');
		$i = 0;
		if(!file_exists($file)){
			$this->createCSV($csv);
			$file = $this->getCSVFile();
		}
		$tempArray = $this->readCSV($file);
		$temp2Array = array();
		$retArray = array();
		
		foreach($tempArray as $row=>$add){
			$i += 1;
			array_push($retArray, $add);
		}

		array_push($temp2Array, $i);
		array_push($temp2Array, $array[0]);
		array_push($temp2Array, $array[1]);
		array_push($temp2Array, $array[2]);
		array_push($tempArray, $temp2Array);

		foreach($tempArray as $row=>$next){
			fputcsv($tempFile, $next);
		}

		rename('files/temp.csv', $file);
	}

	// Delete CSV
	public function deleteCSV($file, $index){
		echo $index;
		$deleted = 0;
		$tempFile = fopen('files/temp.csv', 'a');
		if(!file_exists($file)){
			$this->createCSV('records');
			$file = $this->getCSVFile();
		}
		$tempArray = $this->readCSV($file);
		$temp2Array = array();
		foreach($tempArray as $row=>$next){
			if($deleted == 0){
				if($next[0] != $index){
					array_push($temp2Array, $next);
				}else{
					$deleted = 1;
				}
			}else{
				$next[0] -= 1;
				array_push($temp2Array, $next);
			}
		}
		foreach($temp2Array as $row=>$next){
			fputcsv($tempFile, $next);
		}
		rename('files/temp.csv', $file);
	}
	
	// Update CSV
	public function updateCSV($file, $array){
		$tempFile = fopen('files/temp.csv', 'a');
		if(!file_exists($file)){
			$this->createCSV('records');
			$file = $this->getCSVFile();
		}
		$tempArray = $this->readCSV($file);
		$temp2Array = array();
		foreach($tempArray as $row=>$next){
			if($next[0] == $array[0]){
				$next[1] = $array[1];
				$next[2] = $array[2];
				$next[3] = $array[3];
 			}
 			array_push($temp2Array, $next);
		}
		foreach($temp2Array as $row=>$next){
			fputcsv($tempFile, $next);
		}
		rename('files/temp.csv', $file);
	}

	// Get CSV
	public function getCSVFile(){
		if(!file_exists($this->csv)){
			$this->createCSV('records');
		}
		return $this->csv;
	}

}
?>
