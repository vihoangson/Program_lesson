<?php
//Testmod to login
$security_mod = true;
if($security_mod){
	session_start();
	if($_SESSION["login"]!=1){
		header("Location:login.php");
	}
}
?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Program Lesson</title>

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
		<div class="container" style="position:relative;">
			<section>
				<h1>Program Lesson</h1>
				<div style="position:absolute; top:0;right:0;">
					<a href="/login.php?op=logout" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-off"></span> Logout</a>
				</div>
				<div class="well">
					<ul>
						<li><a href="Lesson_1">Lesson 1</a></li>
						<li><a href="Lesson_2">Lesson 2</a></li>
						<li><a href="Lesson_3">Lesson 3</a></li>
						<li><a href="Lesson_4">Lesson 4</a></li>
						<li><a href="Lesson_5">Lesson 5</a></li>
						<li><a href="Lesson_6">Lesson 6</a></li>
					</ul>
				</div>
			</section>
			<hr>
			<section>
				<h1>Project test</h1>
				<div style="position:absolute; top:0;right:0;">
					<a href="/login.php?op=logout" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-off"></span> Logout</a>
				</div>
				<div class="well">
					<ul>
						<li><a href="Test_case_1">Test case 1</a></li>
					</ul>
				</div>
			</section>
			<hr>
			<section>
				<h1> Relate website</h1>
				<ul>
					<li>
						<a href="https://sharing-vihoangson.rhcloud.com" target="_blank">
							Sharing - Wordpress in Openshift
						</a>
					</li>
					<li>
						<a href="http://santo-vihoangson.rhcloud.com/" target="_blank">
							Program_lesson - PHP in Openshift
						</a>
					</li>
					<li>
						<a href="http://program_lesson.vus.vn/" target="_blank">
							Program_lesson - PHP in Digital Ocean
						</a>
					</li>
				</ul>
			</section>

			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Extentions</h3>
				</div>
				<div class="panel-body">
					<ul>
						<li><a href="/Extentions/phpinfo.php" target="_blank">Php info</a></li>
						<li><a href="/Extentions/bootstrap.php" target="_blank">Bootstrap</a></li>
						<li><a href="https://vihoangson.wordpress.com/wp-admin/upload.php" target="_blank">Upload images___vihoangson@gmail.com__TfJN*CF#7Q##7__</a></li>
					</ul>
				</div>
			</div>

			<div class="container text-center">
				<hr />
				<div class="row">
					<div class="col-lg-12">
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="http://vihoangson.blogspot.com" target="_blank">Vihoangson.blogspot.com</a></li>
								<li><a href="http://vihoangson.wordpress.com" target="_blank">Vihoangson.wordpress.com</a></li>
								<li><a href="http://vihanvietnam.blogspot.com" target="_blank">Vihanvietnam.blogspot.com</a></li>

							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="http://nangluctieman.com" target="_blank">Nangluctieman</a></li>
								<li><a href="http://banhsusu.com" target="_blank">Banhsusu</a></li>
								<li><a href="http://dacsandaklak.vus.vn" target="_blank">Dacsandaklak</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="http://hocboi.vus.vn" target="_blank">Hocboi</a></li>
								<li><a href="http://phapthi.vus.vn" target="_blank">Phapthi</a></li>
								<li><a href="http://santo.vus.vn" target="_blank">Santo</a></li>
								<li><a href="http://www.server-world.info/en/note?os=CentOS_7&p=openstack_kilo&f=1" target="_blank">Server world</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="http://vihoangson.vus.vn" target="_blank">Vihoangson.vus.vn</a></li>
								<li><a href="http://tainangtieman.com" target="_blank">Tainangtieman</a></li>
								<li><a href="http://bootsnipp.com/buttons" target="_blank">Build button</a></li>
								<li><a href="http://loading.io/" target="_blank">Loading.io</a></li>
							</ul>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-pills nav-justified">
							<li><a href="/">© 2015 Vi Hoàng Sơn.</a></li>
							<li><a href="#">Sharing for everyone</a></li>
							<li><a href="#">Privacy</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div><form class="form-horizontal">
<fieldset>
<iframe width="100%" height="300" src="//jsfiddle.net/vihoangson/wb7gsfoh/embedded/" allowfullscreen="allowfullscreen" frameborder="0"></iframe>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			if(localStorage["login"]!=1){
				//location.href = 'login.php';
			}
		</script>
	</body>
</html>