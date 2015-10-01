<?php 
/**
* 
*/
require("class_main.php");
class TestClassName extends PHPUnit_Framework_TestCase
{
	function test_dofunction (){
		$m = new ClassName;
		$this->assertEquals($m->dofunction(),123);
	}
}
 ?>