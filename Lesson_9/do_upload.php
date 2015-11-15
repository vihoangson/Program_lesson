<?php 
 
foreach ($_FILES['file']['name'] as $key => $name) {
	if (move_uploaded_file($_FILES['file']['tmp_name'][ $key], 'uploads/'.$name)) {
		echo "Đã tải lên thành công: <br>";
		echo $name.'<br><br>';
	}
}
 
?>