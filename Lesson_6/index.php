<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>upload</title>
	<link rel="stylesheet" href="">
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

		}
		.dropzone.dragover{
			border-color: #000;
			color: #000;
		}
	</style>

</head>
<body>
	<div id="upload"></div>
	<div class="dropzone" id="dropzone">Thả files vào đây để tải lên</div>
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