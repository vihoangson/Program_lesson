<?php
/**
	* Lession 1:Upload file ajax
	* @github https://github.com/vihoangson/Program_lesson.git
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/
//define("PATH_UPLOAD", $_SERVER["DOCUMENT_ROOT"]."/Lesson_1/store/");
define("PATH_UPLOAD", "store/");
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
if($_POST["submit"] == "download"){
	if(true){
		$files = $_POST["filename"];
		$path_tmp = PATH_UPLOAD;
		$zipname		= 'download_all_file.zip';
		if(file_exists($path_tmp.$zipname)) unlink($path_tmp.$zipname);
		$zip			= new ZipArchive;
		$zip->open($path_tmp.$zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
			$zip->addFile($path_tmp.$file,$file);
		}
		$zip->close();
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename='.$zipname);
		header('Content-Length: ' . filesize($path_tmp.$zipname));
		readfile($path_tmp.$zipname);
	}
}

if(!empty($_POST["form"]) && $_POST["form"] == "action" && $_POST["submit"] == "delete"){
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
		<title>Lesson 1: Test ajax</title>

		<!-- Bootstrap CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

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
			.alert.alert-info.saved-clipboard {
				position: fixed;
				bottom: 20px;
				left: 20px;
				width: 219px;
			}
		</style>
	</head>
	<body>
	<div class="container">
			<center>
				<p><img src="https://vihoangson.files.wordpress.com/2015/08/2015-08-11-12_31_13-lesson-1-tc3acm-ve1bb9bi-google.jpg" style="width:430px"></p>
				<p><img src="https://vihoangson.files.wordpress.com/2015/08/2015-08-11-12_32_20-upload_ajax01-500c397334.jpg" style="width:430px"></p>
			</center>
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
		<hr>
		<div class="well">
				<p><a href="#image_type">Danh sách file hình ảnh</a></p>
				<p><a href="#other_type"> Các loại file khác</a></p>
		</div>

		<form action="" method="post" id="form_action">
			<input type="hidden" name="form" value="action">


			<h3  id="image_type">Danh sách file hình ảnh</h3>
			<p><a href="#">Go top</a></p>
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th></th>
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
							if(file_exists(PATH_UPLOAD.$value) && getimagesize(PATH_UPLOAD.$value)){
								echo '
								<tr>
									<td><input type="checkbox" name="filename[]" value="'.$value.'"></td>
									<td><img src="show_img.php?file='.$value.'" style="width:50px;"></td>
									<td>'.$value.'</td>
									<td>

										<div class="input-group">
											<input type="text" class="form-control" id="input_'.$key.'" placeholder="Search" value="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].PATH_UPLOAD.$value.'">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" onclick="add_clipboard(\'#input_'.$key.'\');"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
											</span>
										</div>
										<div class="input-group">
											<input type="text" class="form-control" id="input_img_'.$key.'" placeholder="Search" value=\'<img src="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].PATH_UPLOAD.$value.'"> \'>
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" onclick="add_clipboard(\'#input_img_'.$key.'\');"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
											</span>
										</div>
									</td>

								</tr>
								';
							}else{
								$list_otherfile[]=$value;
							}

						}
					?>
				</tbody>
			</table>


			<h3 id="other_type"> Các loại file khác</h3>
			<p><a href="#">Go top</a></p>
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($list_otherfile as $key => $value) {
							if($value == "." ||$value == "..") {
								continue;
							}
							if(file_exists(PATH_UPLOAD.$value)){
								echo '
								<tr>
									<td><input type="checkbox" name="filename[]" value="'.$value.'"></td>
									<td></td>
									<td>'.$value.'</td>
									<td>

										<div class="input-group">
											<input type="text" class="form-control" id="input_'.$key.'" placeholder="Search" value="http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].PATH_UPLOAD.$value.'">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default" onclick="add_clipboard(\'#input_'.$key.'\');"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
											</span>
										</div>
									</td>

								</tr>
								';
							}else{
								$list_otherfile[]=PATH_UPLOAD.$value;
							}

						}
					?>
				</tbody>
			</table>

			<button type="submit" class="btn btn-danger" name="submit" value="delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</button> 
			<button type="submit" class="btn btn-danger" name="submit" value="download"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Download All</button> 
			<button type="button" class="btn btn-warning" onclick='$("input[type=checkbox]").prop("checked",true);'><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Check all</button> 
			<button type="button" class="btn btn-warning" onclick='$("input[type=checkbox]").prop("checked",false);'><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Uncheck all</button> 
		</form>

		<center><a href="/" class="btn btn-lg btn-default"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Back to home page</a></center>

		


	</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<script>
			function add_clipboard(e){
				copyToClipboard($(e).val());
				$("body").prepend('<div class="alert alert-info saved-clipboard" role="alert">Save to clipboard !</div>');
				$(".alert").delay(1000).fadeOut(500);
			}

			function copyToClipboard(value) {
				var $temp = $("<input type=''>");
				$("body").append($temp);
				$temp.val(value).select();
				document.execCommand("copy");
				$temp.remove();
			}

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
