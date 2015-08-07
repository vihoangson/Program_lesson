<?php
define("PATH_UPLOAD", $_SERVER["DOCUMENT_ROOT"]."/uploadfile/store/");
if(!file_exists(PATH_UPLOAD)){
	mkdir(PATH_UPLOAD);
	chmod(PATH_UPLOAD,0777);
}

if(!empty($_POST["form"]) && $_POST["form"] == "uploadfile"){
	if(is_array($_FILES["input_file"]["name"])){
		foreach ($_FILES["input_file"]["name"] as $key => $value) {
			if(@move_uploaded_file( $_FILES["input_file"]["tmp_name"][$key],PATH_UPLOAD.$_FILES["input_file"]["name"][$key])){
				echo "Upload finish: ".$_FILES["input_file"]["name"][$key]."\n";
			}else{
				echo "Error in upload: ".$_FILES["input_file"]["name"][$key]."\n";
			}
		}
	}else{
		if(@move_uploaded_file( $_FILES["input_file"]["tmp_name"],PATH_UPLOAD.$_FILES["input_file"]["name"])){
			echo "Upload finish: ".$_FILES["input_file"]["name"]."\n";
		}else{
			echo "Error in upload: ".$_FILES["input_file"]["name"]."\n";
		}
	}
	exit;
}

if(!empty($_POST["form"]) && $_POST["form"] == "action"){
	foreach ($_POST["filename"] as $key => $value) {
		unlink(PATH_UPLOAD.$value);
	}
}

?>
	<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Test ajax</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			.loadding_ajax {
				height: 11px;
				width: 400px;
				background: #ECECEC;
				margin-top: 10px;
				display:none;
			}

			.loadding_ajax span {
				width: 0%;
				height: 11px;
				background: #A3A3AB;
				display: block;
			}
		</style>
	</head>
	<body>
	<div class="container">
		<form action="" method="POST" role="form" enctype="multipart/form-data" id="form_ajax">
			<legend>Form title</legend>
			<div class="form-group">
				<label for="">File</label>
				<input type="file" name="input_file" class="form-control" id="" placeholder="Input field">
				<input type="hidden" name="form" value="uploadfile">
			</div>
			<input type="hidden" name="post" value="1">
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<form action="" method="POST" role="form" enctype="multipart/form-data" id="form_ajax">
			<legend>Form title</legend>
			<div class="form-group">
				<label for="">File</label>
				<input type="file" name="input_file[]" class="form-control" id="" placeholder="Input field" multiple >
				<input type="hidden" name="form" value="uploadfile">
			</div>
			<input type="hidden" name="post" value="1">
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<form action="" method="post" id="form_action">
			<input type="hidden" name="form" value="action">
			<h3>Danh sách file</h3>
		<table class="table table-hover">
			<thead>
				<tr>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$array_d = scandir(PATH_UPLOAD);
					foreach ($array_d as $key => $value) {
						if($value == "." ||$value == "..") {
							continue;
						}
						echo '
						<tr>
							<td><input type="checkbox" name="filename[]" value="'.$value.'"></td>
							<td>'.$value.'</td>
						</tr>
						';
					}
				?>
			</tbody>
		</table>
		<button type="submit" class="btn btn-danger">Delete</button>
		</form>
	</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<script>
			$("input[name='input_file[]']").change(function(){
				$(this).closest('form').submit();
			});
			$("input[name='input_file']").change(function(){
				$(this).closest('form').submit();
			});
			
			$("form#form_action").submit(function(event) {
				return confirm("Bạn có muốn thực hiện?");
			});
			$("form#form_ajax").submit(function(event) {
				//$(this).after('<div class="loadding_ajax_text"></div><div class="loadding_ajax"><span></span></div>');
				$(this).after('<div class="progress progress-striped"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">0% Complete (success)</span></div></div>');
				var formData		= new FormData($(this)[0]);
					$.ajax({
						url: '',
						type: 'POST',
						data: formData,
						cache: false,
						dataType: 'html',
						contentType: false,
						enctype: 'multipart/form-data',
						processData: false,
						xhr: function() {
							var myXhr = $.ajaxSettings.xhr();
							if(myXhr.upload){
								myXhr.upload.addEventListener('progress',progress, false);
							}
							return myXhr;
						},
						success: function (response) {
							console.log(response);
							console.log("success");
							location.reload();
						},
						fail: function(){
							console.log("error");
						},
						beforeSend: function(){
							$(".loadding_ajax").show(300);
							console.log("start to upload");	
						}
					});
					return false;
			});

			function progress(e){
				if(e.lengthComputable){
					var max = e.total;
					var current = e.loaded;
					var Percentage = Math.round((current * 100)/max);
					$(".progress-bar").css({"width":Percentage+"%"});
					$(".sr-only").html((Percentage)+"%");
					if(Percentage >= 100){
						$(".progress-bar").remove();
						$(".sr-only").remove();
					}
				}
			}

		</script>
	</body>
</html>
