<?php
echo "
<hr>
<h3><p><a href='index.php?case=mysql'>Mysql - Deliberate</a></p></h3>
<h3><p><a href='index.php?case=mysql&amp;op=random'>Mysql - Random</a></p></h3>
<h3><p><a href='index.php?case=variable'>Variable - Deliberate</a></p></h3>
<h3><p><a href='index.php?case=variable&amp;op=random'>Variable - Random</a></p></h3>
<hr>
";
if(!isset($_GET["case"])){
	return;
}
if($_GET["case"]!="no_db"){
	$s = microtime(true);
	if($_GET["case"]){
		$case = $_GET["case"];
	}else{
		$case = "mysql";
	}
	

	switch($case){
		case "mysql":
			if(isset($_GET["op"]) && $_GET["op"]=="random"){
				$conn	=mysql_connect("localhost","root","");
				mysql_set_charset('utf8',$conn);
				mysql_select_db("test_case",$conn);
				$sql	="select * from user order by rand() limit 10";
				$query	=mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "Chua co du lieu";
					die;
				}
			}else{
				$conn	=mysql_connect("localhost","root","");
				mysql_set_charset('utf8',$conn);
				mysql_select_db("test_case",$conn);
				$sql	="select * from user limit 10";
				$query	=mysql_query($sql);
				if(mysql_num_rows($query) == 0){
					echo "Chua co du lieu";
					die;
				}
			}
		break;
		case "variable":
			require("db.php");
			if(isset($_GET["op"]) && $_GET["op"]=="random"){
				$max = count($array_data);
				foreach ($array_data as $key => $value) {
					$array_data_tmp[] = $array_data[rand(1,$max)];
					if($key>=10){
						break;
					}
				}
			}else{
				foreach ($array_data as $key => $value) {
					$array_data_tmp[] = $value;
					if($key>=10){
						break;
					}
				}
			}
			$array_data = $array_data_tmp;
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
if($case == "mysql"){
	mysql_close($conn);
}
 ?>