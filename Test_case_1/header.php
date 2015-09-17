<?php
//==============================================================================
if($_GET["test_mod"]==1){
	$ip = $_SERVER['REMOTE_ADDR'];
	$maxRequestsAllowed = 2000;
	$ips = @unserialize(file_get_contents(__DIR__."/ipban.data"));
	if (!is_array($ips)) {
		$ips = array();
	}
	if (!isset($ips[$ip])) {
		$ips[$ip] = 0;
	}
	if($_GET["test_mode"]==1){
		print_r($ips);
	}
	$ips[$ip] += 1;
	file_put_contents(__DIR__.'/ipban.data', serialize($ips));
	if ($ips[$ip] > $maxRequestsAllowed) {
		die;
	}

}
//==============================================================================
session_start();
//Testmod to login
$security_mod = false;
if($security_mod){
	session_start();
	if($_SESSION["login"]!=1){
		header("Location:/login.php");
	}
}
require("class/db.php");
if(preg_match("/^fix_/", $_GET["op"])){
	$db->$_GET["op"]();
	die;
}
 ?><!DOCTYPE HTML>
<html>
	<head>
		<title>Development Lap by CSV</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!-- <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:700italic,400,300,700' rel='stylesheet' type='text/css'> -->
		<link href="template/css/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="template/js/skel.min.js"></script>
		<script src="template/js/skel-panels.min.js"></script>
	<script src="template/js/init.js"></script>
		<link rel="stylesheet" href="template/css/skel-noscript.css" />
		<link rel="stylesheet" href="template/css/style.css" />
		<link rel="stylesheet" href="template/css/style-desktop.css" />
		<noscript>
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<style type="text/css">
			.box_top_debug {
				position: fixed;
				top: 2px;
				z-index: 1;
				right: 3px;
				background-color: #E95D3C;
				border-radius: 5px;
				padding: 7px;
			}
			.img_thumb{
				width:100px;
				float:left;
				margin-right:10px;
			}
			.pagination_box li {
				float: left;
			}

			.pagination_box li a {
				padding: 2px;
				display: block;
				padding: 4px;
				text-decoration: none;
			}
		</style>
		<script type="text/javascript">
		function change_case_db(var_db){
			$.post("/Test_case_1/index.php",{op:"change_db",case_change:var_db,ajax:true},function(data){console.log(data)});
			//location.reload();
			window.location.reload();
		}
		</script>
	</head>
	<body class="right-sidebar">
		<div class="box_top_debug">
			<?php echo $db->time_load_db; ?>
			<button class="btn btn-default" type="button" onclick="$('.toggle_box').toggle(500);">Change db case</button>
			<div class="toggle_box" style="display:none;">
				<p><a href="javascript:void(0)" onclick="change_case_db('csv')" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> CSV</a></p>
				<p><a href="javascript:void(0)" onclick="change_case_db('mysql')" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> MySQl</a></p>
				<p><a href="javascript:void(0)" onclick="change_case_db('variable')" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-ok-circle"></span> Variable</a></p>
			</div>

		</div>
	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="index.php">Ex Machina</a></h1>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li class="active"><a href="index.php">Homepage</a></li>
							<li><a href="left-sidebar.html">Left Sidebar</a></li>
							<li><a href="right-sidebar.html">Right Sidebar</a></li>
							<li><a href="no-sidebar.html">No Sidebar</a></li>
						</ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
		
	<!-- Banner -->
		<div id="banner">
			<div class="container">
			</div>
		</div>
	<!-- /Banner -->

	<!-- Main -->
		<div id="page">
				
			<!-- Main -->
			<div id="main" class="container">
				<div class="row">