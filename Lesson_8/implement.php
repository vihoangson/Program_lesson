<?php 
interface Document{
	public function getData();
	public function setData();
}

class MyDocument implements Document{

	public static function init(){
		self::doData();
		self::setData();
		self::cutData();
	}

	private static function doData(){
		echo "This is function doData";
	}

	public function setData(){
		echo "setData";
	}

	public function getData(){
	}

	public function cutData(){
		try{
			echo "cutData";
			throw new Exception("Exception 1");
			self::cancelData();
		}catch(Exception $e){
			header("HTTP/1.1 400 Bad request");
			echo "<br>";
			echo $e->getMessage();
			echo "<br>";
		}
	}

	public function cancelData(){
		if(true){
			throw new Exception("Exception 2");
		}
	}

}

MyDocument::init();
