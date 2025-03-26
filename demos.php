<?php
    include './includes/header.php';
?>
    <?php
        include './includes/navigation-2.php';
    ?>

<div class='page-wrapper'>
	<?php
      $arg = array(
        'url' => './demos',
        'url_text' => 'Demos',
        'title' => 'Demos'
      );
      banner_section($arg);
    ?>


  			<!--
			=====================================================
				Project Section
			=====================================================
			-->
			<div id="project-section">
				<div class="container">
					<div class="theme-title">
						<h2>OUR AWESOME PROJECTS</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
					</div> <!-- /.theme-title -->

					<div class="project-menu">
						<ul>
	        				<!-- <li class="filter active tran3s" data-filter="all">All</li>
							<li class="filter tran3s" data-filter=".web">Web Design</li>
							<li class="filter tran3s" data-filter=".photo">Photography</li>
							<li class="filter tran3s" data-filter=".webd">Web Development</li>
							<li class="filter tran3s" data-filter=".om">Online Marketing</li>
							<li class="filter tran3s" data-filter=".dmedia">Digital Media</li>
							<li class="filter tran3s" data-filter=".support">Support</li> -->
	        			</ul>
					</div>

					<div class="project-gallery clear-fix d-flex">
						<?php
							$demo = new Demo();
							echo $demo->demos();
						?>


					</div> <!-- /.project-gallery -->
				</div> <!-- /.container -->
			</div> <!-- /#project-section -->
</div>






<?php
    include './includes/footer.php';
?>