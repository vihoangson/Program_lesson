<?php
require("pagination.php");
/**
* 
*/
class Db_csv{
	public $data;
	public $time_load_db;
	function __construct(){
		$s = microtime(true);
		$file = __DIR__.'/../db/database.csv';
		$row = 1;
		if (($handle = fopen($file, "r")) !== FALSE) {
			$csv = array();
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				if($row==1){
					$column_name = $data;
				}else{
					foreach ($column_name as $key => $value) {
						$this->data[$data[0]][$value] = $data[$key];
					}
				}
				$row ++;
			}
			fclose($handle);
		}
		$e = microtime(true);
		$this->time_load_db = "Time load db: ".($e-$s);
		
	}

	function getAllData(){
		return $this->data;
	}

	function getAllDataPager($limit=10,$offset=0){
		$value = array_values($this->data);
		$all_row = count($value);
		$all_page = round($all_row/$limit);
		$this->pagination = new pagination;
		
		for($i=0;$i<=$limit;$i++){
			$return["data"][$value[$i+$offset]["id"]] = $value[$i+$offset];
		}
		$return["pager"]["html"] = "<ul></ul>";

		return $return;
	}

	function getDetailArticle($id){
		return $this->data[$id];
	}
}
$db = new Db_csv;
 ?>