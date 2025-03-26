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

					<h1 class="h3 mb-3">Projects</h1>

					<div class="row">
					<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<!-- <div class="card-header">

									<h5 class="card-title mb-0">Latest Projects</h5>
								</div> -->
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Start Date</th>
											<th class="d-none d-xl-table-cell">End Date</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Assignee</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                            $project = new Project();
                                            echo $project->projects();
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