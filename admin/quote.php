<?php
	include './header.php';
?>
	<div class="wrapper">
		<?php
			include './includes/sidebar.php';
		?>

		<div class="main">
			<?php
				include './includes/navbar.php';
			?>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Quote Details</h1>

					<div class="row">


                        <div class="col-12 col-md-6 col-lg-8">
                            <?php
                                $quote = new Quote();
                                echo $quote->quote_admin($_GET['qid']);
                            ?>
						</div>

					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>