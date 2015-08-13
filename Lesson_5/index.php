<?php
/**
	* Lesson 5: AutoSave in Jquery
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/
require_once("class/sqlite.php");
require_once("class/lesson5.php");
$sqlite = new My_sqlite;
$lesson5 = new Lesson5($sqlite);
if($_POST["ajax"]){
	//
	// Security mod filter variable before save (true|false)
	//
	$security_mod = true;
	if($security_mod){
		$text = base64_encode($_POST["text"]);
	}else{
		$text = ($_POST["text"]);
	}

	$sql	= "SELECT * FROM text_tb where text_id=1 ";
	$rs		= $sqlite->query($sql);
	$data	= ($sqlite->fetchAll($rs));
	if(count($data)==0){
		$sql='INSERT INTO text_tb("text_id","text_c") VALUES (1,"'.$text.'");';
	}else{
		$sql= 'UPDATE text_tb SET	text_c	= "'.$text.'"	WHERE text_id=1';
	}
	if(!$sqlite->exec($sql)){
		$error=true;
		echo 0;
	}else{
		$error=false;
		echo 1;
	}
	die;
}else{
	$sql	= "SELECT * FROM text_tb where text_id=1 ";
	$rs		= $sqlite->query($sql);
	$data	= ($sqlite->fetchAll($rs));
	$str	= base64_decode(($data[0]["text_c"]));
	//
}
?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lesson 5: AutoSave in Jquery</title>
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">

			<section>
				<h1>Auto save by Jquery</h1>
				<div class="well">
					<p>ctrl+S: To save in DB</p>
					<p>Sau 3s không nhập sẽ tự động lưu vào DB</p>
					<p>PhpSqliteAdmin - <a href="db/phpliteadmin.php" target="_blank">View DB</a></p>
				</div>
				<textarea id="myInput" class="form-control" style="height:400px"><?php echo $str; ?></textarea>

				<div style="margin-top:10px;">
					<button onclick="doneTyping()" type="button" class="top5 btn btn-default"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> Save (Ctrl+S)</button>
				</div>

				<center><a href="/" class="btn btn-lg btn-default"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Back to home page</a></center>
			</section>
		</div>
 
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$('#myInput').focus();
			//setup before functions
			var typingTimer;                //timer identifier
			var doneTypingInterval = 3000;  //time in ms, 1 second for example

			//on keyup, start the countdown
			$('#myInput').keydown(function(e){
				if ((e.which == 83 || e.which == 115) && e.ctrlKey ==true) {
					console.log("in"+$.now());
				}else{
					clearTimeout(typingTimer);
					if ($('#myInput').val) {
						typingTimer = setTimeout(doneTyping, doneTypingInterval);
					}
				}
			});

			$(document).keydown(function(e){
				//key [ctrl+S]
				if ((e.which == 83 || e.which == 115) && e.ctrlKey ==true) {
					doneTyping ();
					e.preventDefault();
				}
			});

			//user is "finished typing," do something
			function doneTyping () {
					$.ajax({
						url: '/Lesson_5/',
						type: 'POST',
						dataType: 'html',
						data: {"text":$("#myInput").val(),"ajax":1}
					})
					.done(function(data) {
						console.log(data);
						if(data==0){
							alert("error");
						}else{
							if($(".alert").length==0){
								$("body").prepend('<div class="alert alert-info saved-clipboard" role="alert">Save to database !</div><style>.alert.alert-info.saved-clipboard {position: fixed;top: 20px;right: 20px;width: 219px;}</style>');
							}else{
								$(".alert").fadeIn(500);
							}
							$(".alert").delay(100).fadeOut(500);
						}
					})
					.fail(function() {
						console.log("error");
					});
			}
		</script>
	</body>
</html>
