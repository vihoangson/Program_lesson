<?php
/**
	* Lesson 3: Markdow
	* Markdown là gì?
	* Về định nghĩa thì Markdown là một ngôn ngữ đánh dấu. Wtf?? Thế ngôn ngữ đánh dấu là gì? Ngôn ngữ đánh dấu rất đơn giản là một cách để làm cho một vài đoạn văn bản có ý nghĩa khác với các đoạn khác.
	* VD: Đây là một chữ nghiêng.
	* Rõ ràng chúng ta đã đánh dấu chữ "nghiêng" có ý nghĩa khác với các chữ còn lại trong câu. Ngôn ngữ đánh dấu chỉ đơn giản là vậy thôi.
	* Có nhiều kiểu ngôn ngữ đánh dấu khác nhau phục vụ nhiều mục đích khác nhau. Trong đó loại nổi tiếng nhất là HTML (và XHTML) dùng cho web.
	* @github https://github.com/vihoangson/Program_lesson.git
	*
	* **Nguồn tham khảo**
	* http://nguyenthethang.com/2013/08/16/keyword-ngon-ngu-markdown-la-gi-what-is-markdown/
	* http://ngochin.com/2013/01/03/markdown/
	* @author Vi Hoàng Sơn <vihoangson@gmail.com>
**/
	require_once("class/Parsedown.php");
	$parsedown = new Parsedown;
	$string    = (isset($_POST["input_markdown"])?$_POST["input_markdown"]:"");
	$text      = $parsedown->text($string);
	if(!$string){
		$string = "
Heading
=======

Sub-heading
-----------

### Another deeper heading

Paragraphs are separated
by a blank line.

Leave 2 spaces at the end of a line to do a
line break

Text attributes *italic*, **bold**,
`monospace`, ~~strikethrough~~ .

A [link](http://example.com).
[27]

Shopping list:

  * apples
  * oranges
  * pears

Numbered list:

  1. apples
  2. oranges
  3. pears

The rain---not the reign---in
Spain.

![vihoangson@gmail.com](https://avatars3.githubusercontent.com/u/4572510?v=3&s=460)
		";
		$_POST["input_markdown"] = $string;
	}
	$text		= $parsedown->text($string);


$string_sample	= file_get_contents("data_sample.php");
$text_sample	= $parsedown->text($string_sample);
?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lesson 3: Pares markdown</title>

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
			<center>
				<p><img src="https://vihoangson.files.wordpress.com/2015/08/2015-08-11-12_23_14-lesson-3-tc3acm-ve1bb9bi-google.jpg" style="width:430px"></p>
				<p><img src="https://vihoangson.files.wordpress.com/2015/08/2015-08-11-12_24_58-markdown-tc3acm-ve1bb9bi-google.jpg" style="width:430px"></p>
			</center>
			<section>
				<h1>Part 1: Input in textarea</h1>
				<form action="" method="POST" role="form">
					<legend>Markdown</legend>
					<div class="form-group">
						<label for="">label</label>
						<textarea class="form-control" id="" name="input_markdown" placeholder="Textarea field" style="height:250px;"><?php echo $_POST["input_markdown"]; ?></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>

				<h2>Preview</h2>
				<div class="well"><?php echo $text ?></div>

			</section>


			<hr>
			<section>
				<h1>Part 2: Data sample in file data_sample.php</h1>
				<div class="well"><?php echo $text_sample ?></div>
			</section>

			<center><a href="/" class="btn btn-lg btn-default"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Back to home page</a></center>


		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>
