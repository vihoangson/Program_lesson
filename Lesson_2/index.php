<?php
/**
	* Lession 2:Submit form by ajax
	* @github https://github.com/vihoangson/Program_lesson.git
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/

require_once("class/sqlite.php");
require_once("class/lesson2.php");
$sqlite = new My_sqlite;
$lesson2 = new Lesson2($sqlite);


if(preg_match("/^do_/", $_GET["do"])){
	$lesson2->{$_GET["do"]}();
}

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

		<?php $lesson2->show_form_edit(); ?>
		<?php $lesson2->show_result(); ?>

	</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$("form input[name='name_txt']").focus();

$(document).keydown(function(e){
	//key [F4]
	if (e.which == 115) {
		e.preventDefault();
		//$("#form_submit").submit();
		$("button[name='form']").trigger("click");
	}
});
	</script>
	</body>
</html>
