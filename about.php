<?php
    include './includes/header.php';
?>
    <?php
        include './includes/navigation-2.php';
    ?>

<div class='page-wrapper'>
    <?php
      $arg = array(
        'url' => './about',
        'url_text' => 'About',
        'title' => 'About'
      );
      banner_section($arg);
    ?>
    <!--==========================
    About Section
    ============================-->
    <?php
        $about = new About();
        echo $about->about_page_content();
    ?>
</div>





<?php
    include './includes/footer.php';
?>