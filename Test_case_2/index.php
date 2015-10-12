<?php
echo "
<hr>
<h3><p><a href='index.php?op=deliberate'>Deliberate</a></p></h3>
<h3><p><a href='index.php?op=random'>Random</a></p></h3>
<h3><p><a href='index.php?op=delete'>Clear cache</a></p></h3>
<hr>
";
if (!function_exists('mysql_fetch_all'))
{
	/**
	 * Fetches all rows from a MySQL result set as an array of arrays
	 *
	 * Requires PHP >= 4.3.0
	 *
	 * @param   $result       MySQL result resource
	 * @param   $result_type  Type of array to be fetched
	 *                        { MYSQL_NUM | MYSQL_ASSOC | MYSQL_BOTH }
	 * @return  mixed
	 */
	function mysql_fetch_all ($result, $result_type = MYSQL_BOTH)
	{
		if (!is_resource($result) || get_resource_type($result) != 'mysql result')
		{
			trigger_error(__FUNCTION__ . '(): supplied argument is not a valid MySQL result resource', E_USER_WARNING);
			return false;
		}
		if (!in_array($result_type, array(MYSQL_ASSOC, MYSQL_BOTH, MYSQL_NUM), true))
		{
			trigger_error(__FUNCTION__ . '(): result type should be MYSQL_NUM, MYSQL_ASSOC, or MYSQL_BOTH', E_USER_WARNING);
			return false;
		}
		$rows = array();
		while ($row = mysql_fetch_array($result,$result_type))
		{
			$rows[] = $row;
		}
		return $rows;
	}
}

$servers = array(
	array('localhost', 11211, 33),
);
$memcached = new Memcached;
$memcached->addServers($servers);

if(isset($_GET["op"])){
	switch($_GET["op"]){
		case "deliberate":
			if(!$memcached->get("data_user")){
				$db = array();
				$conn   =mysql_connect("localhost","root","");
				mysql_set_charset('utf8',$conn);
				mysql_select_db("test_case",$conn);
				$sql    ="select * from user limit 10";
				$query  =mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "Chua co du lieu";
					die;
				}
				$query_rs = (mysql_fetch_all($query));

				$memcached->set("data_user",$query_rs);
			}

			$s = microtime(true);
			//Code tesct speed
			$m= $memcached->get("data_user");
			foreach ($m as $key => $value) {
				echo "<h3>".$value["name"]."</h3>";
			}
			$e = microtime(true);
			echo "<h3>".($e-$s)."</h3>";
		break;
		case "random":
			if(!$memcached->get("data_user_rand")){
				$db = array();
				$conn   =mysql_connect("localhost","root","");
				mysql_set_charset('utf8',$conn);
				mysql_select_db("test_case",$conn);
				$sql    ="select * from user order by rand() ";
				$query  =mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "Chua co du lieu";
					die;
				}
				$query_rs = (mysql_fetch_all($query));

				$memcached->set("data_user_rand",$query_rs);
			}

			$s = microtime(true);
			$m= $memcached->get("data_user_rand");
			$max = count($m);
			foreach ($m as $key => $value) {
				echo "<h3>".$m[rand(1,$max)]["name"]."</h3>";
				if($key>10){
					break;
				}
			}
			$e = microtime(true);
			echo "<h3>".($e-$s)."</h3>";
		break;
		case "delete":
			$memcached->delete("data_user");
			$memcached->delete("test_case_rand");
			echo "<h2>Clear ... </h2>";
		break;
	}
}
