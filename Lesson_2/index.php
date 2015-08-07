<?php
/**
	* Lession 2:Submit form by ajax
	* @github https://github.com/vihoangson/Program_lesson.git
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/
if(!empty($_POST["form"]) && $_POST["form"] == "uploadfile"){
	exit;
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
		<form action="" method="POST" role="form" enctype="multipart/form-data" id="form_ajax">
			<legend>Form title</legend>
			<div class="form-group">
				<label for="input_name">Họ và tên</label>
				<input type="text" name="name_txt" class="form-control" id="input_name" placeholder="Nguyễn Văn A">
			</div>
			<div class="form-group">
				<label for="">Họ và tên</label>
				<input type="text" name="name_txt" class="form-control" id="" placeholder="Nguyễn Văn A">
			</div>
			<input type="hidden" name="post" value="1">
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

		<script>
			$("form#form_ajax").submit(function(event) {
				//$(this).after('<div class="loadding_ajax_text"></div><div class="loadding_ajax"><span></span></div>');
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
