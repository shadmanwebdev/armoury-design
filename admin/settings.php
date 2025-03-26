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

					<h1 class="h3 mb-3">Settings</h1>

					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
										Account
										</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
										Password
									</a>
									<!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Privacy and safety
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Email notifications
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Web notifications
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Widgets
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Your data
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
										Delete account
									</a> -->
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Public info</h5>
										</div>
										<div class="card-body">
											<?php
												$user->public_info_form()
											?>

										</div>
									</div>

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">

										<?php
											$user->private_info_form()
										?>
										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form>
												<div id='msg-response'></div>
												<input type='hidden' name='update_pwd' id='update_pwd' value='true'>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" name='current_password' id='current_password'>
													<div class='error' id='current_password_error'></div>
													<!-- <small><a href="#">Forgot your password?</a></small> -->
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" name='new_password' id='new_password'>
													<div class='error' id='new_password_error'></div>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew2">Verify password</label>
													<input type="password" class="form-control" name='repeat_password' id='repeat_password'>
													<div class='error' id='repeat_password_error'></div>
												</div>
												<span onclick='update_pwd(event);' type="submit" class="btn btn-primary">Save changes</span>
											</form>

										</div>
									</div>
								</div>
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