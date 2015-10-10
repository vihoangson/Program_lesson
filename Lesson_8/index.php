<?php 
require "vendor/autoload.php";
use \Michelf\MarkdownExtra;

$my_text="
asdfsdf
==========
";

echo MarkdownExtra::defaultTransform($my_text);