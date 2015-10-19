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
			self::cancelData();
		}catch(Exception $e){
			header("HTTP/1.1 400 Bad request");
			echo $e->getMessage();
		}
	}

	public function cancelData(){
		if(true){
			throw new Exception("không đủ đẹp trai");
		}
	}

}

MyDocument::init();
