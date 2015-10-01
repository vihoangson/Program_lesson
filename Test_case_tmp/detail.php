<?php require "header.php"; ?>
<?php 
		$id = intval($_GET["id"]);
		$data_detail = ($db->getDetailArticle($id));
 ?>
					<div class="9u">
						<section>
							<header>
								<h2><?php echo $data_detail["title"]; ?></h2>
								<span class="byline">Augue praesent a lacus at urna congue rutrum</span>
								<?php
								echo "<p>".$data_detail["content"]."</p>";
								?>
							</header>
						</section>
					</div>
<?php require "footer.php"; ?>