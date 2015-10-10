<?php
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
if($_GET["op"]=="delete"){
	$memcached->delete("qr");
}

if(!$memcached->get("qr")){
	$db = array();
	$conn	=mysql_connect("localhost","root","");
	mysql_set_charset('utf8',$conn);
	mysql_select_db("test_case",$conn);
	$sql	="select * from user";
	$query	=mysql_query($sql);
	if(mysql_num_rows($query) == 0){
		echo "Chua co du lieu";
		die;
	}
	$query_rs = (mysql_fetch_all($query));
	if(is_array($query_rs)){
		$memcached->set("qr",$query_rs);
	}
}

$s = microtime(true);
//Code tesct speed
$m= $memcahed->get("qr");
foreach ($m as $key => $value) {
	echo $value["name"];
}
$e = microtime(true);
echo "<h3>".($e-$s)."</h3>";

?>