<?php
session_start();
if($_POST["op"]=="change_db" && $_POST["ajax"]=="true"){
	$_SESSION["case_db"] = $_POST["case_change"];
	die;
}
require "header.php" ;
?>
	<div class="9u">
		<section>
			<header>
				<h2>Tin tức</h2>
				<span class="byline">Augue praesent a lacus at urna congue rutrum</span>
				<?php
				if($_GET["cid"]){
					$data_pager = $db->getArticlesByCidPager($_GET["cid"],10,intval($_GET["page"]));
				}else{
					$data_pager = ($db->getAllDataPager(10,intval($_GET["page"])));
				}
				
				foreach ($data_pager["data"] as $key => $value) {
					echo "<br>
					".($value["image"] ?"<img src='".$value["image"]."' class='img_thumb'>":"")."
					<h3><a href='detail.php?id=".$value["id"]."'>".$value["title"]."</a></h3>
					<p>".$value["compact"]."</p>
					<div class='clearfix' style='clear:both;'></div>
					<hr>";
				}
				echo $data_pager["pager"]["html"];
				?>
			</header>
		</section>
	</div>
<?php require "footer.php" ?>