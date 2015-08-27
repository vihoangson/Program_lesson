<?php
session_start();
require("pagination.php");
/**
* 
*/
class Db_csv{
	public $data;
	public $time_load_db;
	function __construct(){
		$case_db=$_SESSION["case_db"];
		switch($case_db){
			case "csv":
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
				$this->time_load_db = "Time load db CSV: ".($e-$s);
			break;
			case "mysql":
				$s		= microtime(true);
				$conn	=mysql_connect("localhost","root","");
				mysql_set_charset('utf8',$conn);
				mysql_select_db("test_mysql",$conn);
				$sql	="select * from baiviet";
				$query	=mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "Chua co du lieu";
				}else{
					while($row=mysql_fetch_array($query)){
						$this->data[$row["id"]]=$row;
					}
				}
				$e					= microtime(true);
				$this->time_load_db	= "Time load db Mysql: ".($e-$s);
			break;
			default://variable
				$s		= microtime(true);
				include(__DIR__."/../db/database_variable.php");
				$this->data=$baiviet;
				$e					= microtime(true);
				$this->time_load_db	= "Time load db Variable: ".($e-$s);
			break;
			
		}
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
		$params["link"]		= 'index.php?page=';
		$html = $this->paranation($params);
		for($i=0;$i<$per_page;$i++){
			$return["data"][$value[$i+$offset]["id"]] = $value[$i+$offset];
		}

		$return["pager"]["html"] = "<div class='pagination_box'><ul>".$html."</ul></div>";
		return $return;
	}

	function getArticlesByCidPager($cid,$per_page=10,$page=0){
		$cid = intval($cid);
		$data_by_cat_id=array();
		foreach ($this->data as $key => $value) {
			if($value["cat_id"]==$cid){
				$data_by_cat_id[]=$value;
			}
		}

		$value		= array_values($data_by_cat_id);


		$offset		= $page*$per_page;

		$params["page"]			= $page;
		$params["per_page"]		= $per_page;
		$params["all_row"]		= count($value);
		$params["distance"]		= 5;
		$params["link"]			= 'index.php?cid='.$cid.'&amp;page=';
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

	function fix_img(){
		$return = array();
		$i=0;
		$j=1;
		foreach ($this->data as $key => $value) {
			$i++;
			if(!$value["image"])continue;
			if($i<$j*100)continue;
			error_log($key);
			if(!getimagesize($value["image"])){
				$return[]=$value["id"];
				//error_log($value["id"]);
			}
			if($i>($j*2)*100){
				break;
			}
		}
		error_log("[sss___".implode(",",$return));
	}

	/**
		* paranation
		*
		* params["page"]
		* params["per_page"]
		* params["all_row"]
		* params["distance"]
		* params["link"]
		* @return void
		* @author
	**/

	function paranation($params){
		extract($params);
		if($all_row < $per_page){
			return "";
		}
		$all_page	= round($all_row/$per_page);
		$offset		= $page*$per_page;
		$distance	= ($distance<5?5:$distance);
		$page_li	=array();
		$page_li[]	=1;
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
			$html .= "<li><a ".( (is_numeric($value) && $page != $value) ? "href='".$link.$value :"." )." '>".$value."</a></li>";
		}
		return $html;
	}
}
$db = new Db_csv;
 ?>