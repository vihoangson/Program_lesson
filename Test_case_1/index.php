<?php require "header.php" ?>
	<div class="9u">
		<section>
			<header>
				<h2>Tin tức</h2>
				<span class="byline">Augue praesent a lacus at urna congue rutrum</span>
				<?php
				$all_row = ($db->getAllDataPager(10,2));
				foreach ($all_row as $key => $value) {
					echo "<br>
					".($value["image"]?"<img src='".$value["image"]."' class='img_thumb'>":"")."
					<h3><a href='detail.php?id=".$value["id"]."'>".$value["title"]."</a></h3>
					<p>".$value["compact"]."</p>
					<div class='clearfix' style='clear:both;'></div>
					<hr>";
				}
				?>
			</header>
		</section>
	</div>
<?php require "footer.php" ?>