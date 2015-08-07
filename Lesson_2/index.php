<?php
/**
	* Lession 2:Submit form by ajax
	* @github https://github.com/vihoangson/Program_lesson.git
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/

require_once("class/sqlite.php");

$sqlite = new My_sqlite;



if(!empty($_POST["form"])){

	$user_name		= $_POST["name_txt"];
	$user_email		= $_POST["email_txt"];
	$user_age		= $_POST["age_txt"];
	$user_sex		= $_POST["sex_txt"];
	$user_phone		= $_POST["phone_txt"];
	$user_note		= $_POST["note_txt"];
	$user_finger	= $_POST["finger_txt"];
	
	$sql='INSERT INTO user("user_id","user_name","user_email","user_age","user_sex","user_phone","user_note","user_finger") VALUES
	(null,"'.$user_name.'","'.$user_email.'","'.$user_age.'","'.$user_sex.'","'.$user_phone.'","'.$user_note.'","'.$user_finger.'");';
	$sqlite->query($sql);
	if($_POST["ajax"]){
		exit;
	}
}

$result = $sqlite->query('SELECT * FROM user ORDER BY user_id desc;');
$data = $sqlite->fetchAll($result);

?><!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lession 2:Submit form by ajax</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div class="container">
		<form action="" method="POST" role="form" enctype="multipart/form-data" id="form_ajax">
			<legend>Form title</legend>
			<div class="form-group">
				<label for="input_name">Họ và tên</label>
				<input type="text" name="name_txt" class="form-control" id="input_name" placeholder="Nguyễn Văn A">
			</div>
			<div class="form-group">
				<label for="email_txt">Email</label>
				<input type="text" name="email_txt" class="form-control" id="email_txt" placeholder="nguyenvana@gmail.com">
			</div>
			<div class="form-group">
				<label for="age_txt">Tuổi</label>
				<input type="text" name="age_txt" class="form-control" id="age_txt" placeholder="20">
			</div>
			<div class="form-group">
				<label for="m_id">Giới tính</label>
				<input type="radio" name="sex_txt" class="" id="m_id">
				<label for="m_id">Nam</label>
				<input type="radio" name="sex_txt" class="" id="f_id">
				<label for="f_id">Nữ</label>
			</div>
			<div class="form-group">
				<label for="phone_txt">Điện thoại</label>
				<input type="text" name="phone_txt" class="form-control" id="phone_txt" placeholder="0121 885 1144">
			</div>
			<div class="form-group">
				<label for="finger_tip">Vân tay</label>
				<input type="text" name="finger_txt" class="form-control" id="finger_tip" placeholder="20">
			</div>
			<div class="form-group">
				<label for="note_txt">Ghi chú</label>
				<textarea name="note_txt" id="note_txt" class="form-control"></textarea>
			</div>

			<input type="hidden" name="post" value="1">
			<button type="submit" class="btn btn-primary" name="form" value="submit">Submit</button>
		</form>
		<h2> Dữ liệu đã nhập </h2>
		<table class="table table-hover">
			<thead>
				<tr>
					<th><?php echo "user_id"; ?></th>
					<th><?php echo "user_name"; ?></th>
					<th><?php echo "user_email"; ?></th>
					<th><?php echo "user_age"; ?></th>
					<th><?php echo "user_sex"; ?></th>
					<th><?php echo "user_phone"; ?></th>
					<th><?php echo "user_note"; ?></th>
					<th><?php echo "user_finger"; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($data as $key => $value) {
					?>
					<tr>
						<td><?php echo $value["user_id"]; ?></td>
						<td><?php echo $value["user_name"]; ?></td>
						<td><?php echo $value["user_email"]; ?></td>
						<td><?php echo $value["user_age"]; ?></td>
						<td><?php echo $value["user_sex"]; ?></td>
						<td><?php echo $value["user_phone"]; ?></td>
						<td><?php echo $value["user_note"]; ?></td>
						<td><?php echo $value["user_finger"]; ?></td>
					</tr>
					<?php 
				} ?>

			</tbody>
		</table>		
	</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	</body>
</html>
