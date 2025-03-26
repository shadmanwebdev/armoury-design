<?php
	include './header.php';
?>

<body>
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

					<h1 class="h3 mb-3">Home</h1>

					<div class="row">
						<div class="col-12 col-xl-6">
							<div class="card">
								<!-- <div class="card-header">
									<h5 class="card-title">Basic form</h5>
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div> -->
								<div class="card-body">
									<?php
										echo $home->updateForm();
									?>
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


	<script>
		function fireButton(event) {
			event.preventDefault();
			document.getElementById('image').click();
		}
		$("#image").change(function() {
			var imageSrc = document.getElementById('image').value;
			var imageSrcArr = imageSrc.split('\\');
			var imgName = imageSrcArr.at(-1);
			var imgNameArr = imgName.split('.');
			var imgType = imgName.at(-1);
			document.getElementById('image-name-1').style.display = 'block';
			document.getElementById('image-name-1').textContent = imgName;
		});
		function fireButton2(event) {
			event.preventDefault();
			document.getElementById('background_image').click();
		}
		$("#background_image").change(function(){
			var imageSrc2 = document.getElementById('background_image').value;
			var imageSrc2Arr = imageSrc2.split('\\');
			var imgName2 = imageSrc2Arr.at(-1);
			var imgName2Arr = imgName2.split('.');
			var imgType2 = imgName2.at(-1);
			document.getElementById('image-name-2').style.display = 'block';
			document.getElementById('image-name-2').textContent = imgName2;
		});
	</script>
</body>

</html>