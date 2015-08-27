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

	function getAllDataPager($per_page=10,$page=0){
		$value		= array_values($this->data);
		$offset		= $page*$per_page;

		$params["page"]			= $page;
		$params["per_page"]		= $per_page;
		$params["all_row"]		= count($value);
		$params["distance"]		= 5;
		$html = $this->paranation($params);
		for($i=0;$i<$per_page;$i++){
			$return["data"][$value[$i+$offset]["id"]] = $value[$i+$offset];
		}

		$return["pager"]["html"] = "<div class='pagination_box'><ul>".$html."</ul></div>";
		return $return;
	}

	function getDetailArticle($id){
		return $this->data[$id];
	}
	/**
		* paranation
		*
		* params["page"]
		* params["per_page"]
		* params["all_row"]
		* params["distance"]
		* @return void
		* @author
	**/

	function paranation($params){

		extract($params);
		$all_page = round($all_row/$per_page);
		$offset = $page*$per_page;
		$distance = ($distance<5?5:$distance);
		$page_li=array();
		$page_li[]=1;
		if($page>$distance + 1){
			$page_li[]="...";
		}
		for($i=2;$i<$all_page;$i++){
			if($i > $page-$distance  && $i < $page+$distance ){
				$page_li[]=$i;
			}
		}
		if($page<$all_page-$distance ){
			$page_li[]="...";
		}
		$page_li[] = $all_page;
		$html = "";
		foreach ($page_li as $key => $value) {
			$html .= "<li><a ".( (is_numeric($value) && $page != $value) ? "href='?page=".$value :"." )." '>".$value."</a></li>";
		}
		return $html;
	}
}
$db = new Db_csv;
 ?>