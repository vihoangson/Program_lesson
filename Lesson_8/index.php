<?php
namespace Santo123;
	require("lib/lib.php");
	require("lib/lib2.php");
	use My\Db\Santo ;
	use My\Db\Santo2 ;

	$a = new demo;
	$b = new My\Db\Santo\demo;
	$c = new My\Db\Santo2\demo;

	echo "<hr>";
	$b->demo();
	echo "<br>";
	$c->demo();
	echo "<hr>";

	echo My\Db\Santo\HELLO."<br>";
	echo My\Db\Santo2\HELLO."<br>";

/**
*
*/
class demo
{
	function __construct()
	{
		echo "first_echo<br>";
	}
}