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

if(!empty($_POST["post"])){
	$user_name		= $_POST["name_txt"];
	$user_email		= $_POST["email_txt"];
	$user_age		= $_POST["age_txt"];
	$user_sex		= $_POST["sex_txt"];
	$user_phone		= $_POST["phone_txt"];
	$user_note		= $_POST["note_txt"];
	$user_finger	= $_POST["finger_txt"];
	$user_id		= $_POST["id_txt"];
	if($user_id){
		$sql= 'UPDATE user SET
		user_name	= "'.$user_name.'",
		user_email	= "'.$user_email.'",
		user_age	= "'.$user_age.'",
		user_sex	= "'.$user_sex.'",
		user_phone	= "'.$user_phone.'",
		user_note	= "'.$user_note.'",
		user_finger	= "'.$user_finger.'"
		WHERE user_id='.$user_id;
	}else{
		$sql='INSERT INTO user("user_id","user_name","user_email","user_age","user_sex","user_phone","user_note","user_finger") VALUES
		(null,"'.$user_name.'","'.$user_email.'","'.$user_age.'","'.$user_sex.'","'.$user_phone.'","'.$user_note.'","'.$user_finger.'");';
	}

	if(!$sqlite->exec($sql)){
		$error=true;
	}else{
		$error=false;
	}

	if(intval($_POST["ajax"]) == 1){
		if($error){
			echo 0;
		}else{
			echo $lesson2->show_result();
		}
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
	<style type="text/css">
		.popup_box {
			position: fixed;
			z-index: 10;
			width: 400px;
			top: 20px;
			left: 29%;
			padding:15px;
			background-color: white;
			display:none;
		}
		.back_box {
			background-color: rgba(0, 0, 0, 0.64);
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			z-index: 1;
			display:none;
		}
	</style>
	</head>
	<body>
	<div class="container">

		<?php $lesson2->show_form_edit(); ?>
		<div id="load_result_box"><?php $lesson2->show_result(); ?></div>

	</div>
		<!-- jQuery -->
		<!-- <script src="//code.jquery.com/jquery.js"></script>
		<script src="http://showa.santo.cba/js/jquery-1.8.3.min.js"></script>-->
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->

	<script type="text/javascript">
		$("form input[name='name_txt']").focus();
		$(document).keydown(function(e){
			//key [F4]
			if (e.which == 115) {
				e.preventDefault();
				$("button[name='form']").trigger("click");
			}
		});
		$("body").append("<div class='popup_box'></div>")
		$("body").append("<div class='back_box'></div>")


		$(".back_box").click(function(){
			close_box();
		});

		function edit_user(this_s){
			id = this_s.data("id");
			$.post("/Lesson_2/?do=do_edit",{"id":id},function (data){
				$(".popup_box").html(data);
				$(".back_box").show();
				$(".popup_box").show();
				$(".popup_box .form_submit").addClass('ajax');
				$(".popup_box .form_submit.ajax").append("<input type='hidden' name='ajax' value='1'>");
				$(".popup_box .form_submit.ajax").submit(function(e){
					$.ajax({
						url: '/Lesson_2/',
						type: 'POST',
						dataType: 'html',
						data: $(".popup_box .form_submit.ajax").serialize()
					})
					.done(function(data) {
						console.log(data);
						if(data==0){
							alert("error");
						}else{
							close_box();
							$("#load_result_box").html(data);
						}

					})
					.fail(function() {
						console.log("error");
					})
					.always(function(data) {
					});
					e.preventDefault();
				});
			});
		}

		function close_box(){
			$(".back_box").hide();
			$(".popup_box").hide();
			$(".popup_box .form_submit").remove();

		}
	</script>
	</body>
</html>
