<?php
	include './header.php';
?>
	<div class="wrapper">
		<?php
			include './includes/sidebar.php';
		?>

		<div class="main">
			

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Quotes</h1>

					<div class="row">
                        <div class="col-12 col-xl-6">
							<div class="card">
								<!-- <div class="card-header">
									<h5 class="card-title">Hoverable Rows</h5>
									<h6 class="card-subtitle text-muted">Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.</h6>
								</div> -->
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Phone Number</th>
											<th>Date of Birth</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                            $quote = new Quote();
                                            echo $quote->quotes_admin();
                                        ?>
									</tbody>
								</table>
							</div>
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