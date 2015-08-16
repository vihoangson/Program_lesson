
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lesson 6: Drop zone</title>
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		body{
			font-family: "Arial", sans-serif;
		}
		.dropzone{
			width: 300px;
			height: 300px;
			border: 2px dashed #ccc;
			color: #ccc;
			line-height: 300px;
			text-align: center;
			margin:0 auto;

		}
		.dropzone.dragover{
			border-color: #000;
			color: #000;
		}
	</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">

			<center>
				<p><img src="https://vihoangson.files.wordpress.com/2015/08/2015-08-16-10_04_17-lesson-6-tc3acm-ve1bb9bi-google-e1439694652729.png" style="width:430px"></p>
			</center>

			<section>
				<h1>Drop zone</h1>
				<label for="password">Password: </label>
				<input type="password" id="password" class="form-control">
				<hr>
				<div id="upload"></div>
				<div class="dropzone" id="dropzone">Thả files vào đây để tải lên</div>
				<br>
				<center><a href="/" class="btn btn-lg btn-default"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Back to home page</a></center>
			</section>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			(function(){
				var dropzone=document.getElementById('dropzone');


				dropzone.ondrop=function (e) {
					e.preventDefault();
					this.className='dropzone';
					var files= (e.dataTransfer.files);

					var frm_data=new FormData();
					for (var i = 0; i < files.length; i++) {
						frm_data.append('file[]',files[i]);
						frm_data.append('password',$("#password").val());
					}

					var xhr=new XMLHttpRequest();
					xhr.open('post', 'lesson_6_process.php');

					xhr.onload=function  () {
						var data=this.responseText;
						var upload=document.getElementById('upload');
						upload.innerHTML=data;
					}

					xhr.send(frm_data);

				}
				dropzone.ondragover=function () {
					this.className='dropzone dragover';
					return false;
				}
				dropzone.ondragleave=function () {
					this.className='dropzone';
					return false;
				}
			})();
		</script>
	</body>
</html>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Upload by Drop Zone</title>
	<link rel="stylesheet" href="">


</head>
<body>

</body>
</html>