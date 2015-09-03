<?php
session_start();
if($_GET["op"]=="logout"){
	unset($_SESSION["login"]);
	header("Location:/");
}
if($_GET["op"]=="s"){
	echo "<h1>".strrev("nhanhailannick")."</h1>";
	die;
}
if(
	$_POST["Username"]=="root"
	&&
	md5($_POST["Password"])=="2d48c8962355d6c5443c9de2f71ff696"
){
	$_SESSION["login"]=1;
	header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<style>
		.wrapper {    
			margin-top: 80px;
			margin-bottom: 20px;
		}

		.form-signin {
			max-width: 420px;
			padding: 30px 38px 66px;
			margin: 0 auto;
			background-color: #eee;
			border: 3px dotted rgba(0,0,0,0.1);  
		}

		.form-signin-heading {
			text-align:center;
			margin-bottom: 30px;
		}

		.form-control {
			position: relative;
			font-size: 16px;
			height: auto;
			padding: 10px;
		}

		input[type="text"] {
			margin-bottom: 0px;
			border-bottom-left-radius: 0;
			border-bottom-right-radius: 0;
		}

		input[type="password"] {
			margin-bottom: 20px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}

		.colorgraph {
			height: 7px;
			border-top: 0;
			background: #c4e17f;
			border-radius: 5px;
			background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		}
	</style>
	<body>
		<div class = "container">
			<div class="wrapper">
				<form action="" method="post" name="Login_Form" class="form-signin">
				`<h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
					<hr class="colorgraph"><br>

					<input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
					<input type="password" class="form-control" name="Password" placeholder="Password" required=""/>
					<p><a href="/login.php?op=s" target="_blank">Forget password</a></p>
					<button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>
				</form>
			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>