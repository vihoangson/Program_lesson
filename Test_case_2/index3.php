<?php
if($_GET["case"]!="no_db"){
	$s = microtime(true);
	if($_GET["case"]){
		$case = $_GET["case"];
	}else{
		$case = "mysql";
	}
	

	switch($case){
		case "mysql":
			$conn	=mysql_connect("localhost","root","");
			mysql_set_charset('utf8',$conn);
			mysql_select_db("test_case",$conn);
			$sql	="select * from user";
			$query	=mysql_query($sql);
			if(mysql_num_rows($query) == 0){
				echo "Chua co du lieu";
				die;
			}
		break;
		case "variable":
			require("db.php");
		break;
	}
}

  ?>
<table>
	<tr>
		<td>
		ID
		</td>
		<td>
		Name
		</td>
		<td>
		Address
		</td>
		<td>
		Restaurant ID
		</td>
	</tr>
   <?php
		switch($case){
			case "mysql":
			$key=0;
				while($row=mysql_fetch_array($query)){
					$key++;
					$name			= $row["name"];
					$address		= $row["address"];
					$restaurantID	= $row["restaurantID"];
					?>
					<tr>
						<td><?php echo $key; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $address; ?></td>
						<td><?php echo $restaurantID; ?></td>
					</tr>
					<?php
				}
			break;
			case "variable":
				foreach ($array_data as $key => $value) {
					$name			= $value["name"];
					$address		= $value["address"];
					$restaurantID	= $value["restaurantID"];
					?>
					<tr>
						<td><?php echo $key; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $address; ?></td>
						<td><?php echo $restaurantID; ?></td>
					</tr>
					<?php
				}
			break;
		}
	?>
   </table>
<?php
		//Code test speed
		$e = microtime(true);
		echo "<h3>".($e-$s)."</h3>";
die;
	echo file_get_contents("db.json");
	//echo json_decode(file_get_contents("db.json"));
 ?>