
<?php
    include './includes/header.php';
?>
<?php
    include './includes/navigation.php';
?>
    <!-- <img src="./img/jesse-gardner-mOsenP8t57Q-unsplash.jpg" alt=""> -->
    <!-- <img src="./img/pexels-pixabay-533842.jpg" alt=""> -->
    <!-- <img src="./img/pexels-steven-hylands-1650829.jpg" alt=""> -->
    <!-- <img src="./img/pexels-steven-hylands-3811712.jpg" alt=""> -->
    <!-- HOME -->
    <?php
        echo $home->top_section();
    ?>

    <?php
        $about_section = new AboutSection();
        echo $about_section->about_section();
    ?>

    <!-- ABOUT -->
    <!-- <div class="site-section about-section" id="about-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 img-years mb-lg-0">
            <img src="./img/avel-chuklanov-DUmFLtMeAbQ-unsplash.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto">
            <span class="sub-title">Learn To Know</span>
            <h2 class="sec-ttl mb-4">About Us</h2>
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate fuga ipsum commodi aliquid aspernatur reiciendis enim cum voluptas id itaque, asperiores modi, voluptatibus sed voluptate nulla et ratione aliquam! Quaerat.</p>
            <ul class="list-unstyled ul-check text-left success mb-5">
                <li>
                    Asperiores modi sed
                </li>
                <li>
                    Enim cum voluptas
                </li>
                <li>
                    Commodi aliquid aspernatur
                </li>
                <li>
                    Cupiditate fuga ipsum commodi
                </li>
              </ul>
            <p><a href="#" class="btn btn-primary btn-lg rounded-0">Read More About Us</a></p>
          </div>
        </div>  
      </div>
    </div> -->

    
    <!-- SERVICES -->
    <!-- <section id="services">
        <h2 class="services-title">Services</h2>
        <div class="services-wrap">
            
            <div class="service-wrap">
                <div class="service">
                    <h3>Complete Website</h3>
                    <div class="features">
                        <h4>Features</h4>
                        <p>Modern Design</p>
                        <p>Responsive</p>
                        <p>Mobile Optimization</p>
                        <p>Cross-browser-compatibility</p>
                        <p>Seamless Animations & Effects</p>
                        <p>Google maps</p>
                        <p>Lazy loading</p>
                        <p>Parallax effects</p>
                    </div>
                </div>
            </div>
            
            <div class="service-wrap">
                <div class="service">
                    <h3>Psd Web Template Design</h3>
                    <div class="features">
                        <h4>Features</h4>
                        <p>Unique Layout</p>
                        <p>Pixel-perfect mockup</p>
                        <p>Built using the latest features of Adobe Photoshop</p>
                        <p>Clean, organized Psd template</p>
                        <p>100% conversion</p>
                    </div>
                </div>
            </div>
            

            <div class="service-wrap">
                <div class="service">
                    <h3>Wordpress Website</h3>
                    <div class="features">
                        <h4>Features</h4>
                        <p>Modern Design</p>
                        <p>Online store</p>
                        <p>Mobile Optimization</p>
                    </div>
                    <div class="features">
                        <h4>Plugins</h4>
                        <p>Mailchimp</p>
                        <p>Contact Form 7</p>
                        <p>Woocommerce</p>
                        <p>Paypal</p>
                        <p>TranslatePress</p>
                        <p>WordPress SEO By Yoast</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <div class="testimonial-section" id='testimonial-section'>
        <div class="container block-13 testimonial-wrap">

            <div class="row">
                <div class="col-12 text-center">
                <span class="sub-title">Happy Clients</span>
                <h2 class="sec-ttl display-4">Testimonials</h2>
                </div>
            </div>

            <div class="nonloop-block-13 owl-carousel">
                <?php
                    $testimonial = new Testimonial();
                    echo $testimonial->testimonials();
                ?>
            </div>
        </div>
    </div>

    <!-- <div class='categories'>
        <div ckass='item'>
            <div class='photo'>
                <img src="./img/avi.png" alt="">
            </div>
            <p class=''>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            </p>
        </div>
        <div ckass='item'>
            <p class=''>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            </p>
        </div>
        <div ckass='item'>
            <p class=''>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            </p>
        </div>
        <div ckass='item'>
            <p class=''>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
            </p>
        </div>

    </div> -->

        <!-- faq section -->
        <section class="faq-section py-7" id="faq">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto text-center">
                        <span class="text-muted text-uppercase">Answers to common questions</span>
                        <h2 class="sec-ttl display-4">Frequently asked questions</h2>
                    </div>
                </div>
                <div class="row" id='faq-row-2'>
                    <div class="col-md-10 mx-auto">
                        <div class="row">
                            <?php
                                $faq = new Faq();
                                echo $faq->faqs();
                            ?>
                        </div>
                        <div class="row text-center my-5">
                            <div class="col-lg-6 col-md-8 mx-auto">
                                <div class="font-weight-bold lead">Still have more questions?</div>
                                <p class="text-muted">Magnis modipsae que voloratati andigen daepeditem quiate conecus aut labore.</p>
                                <a href="./contact" class="btn btn-primary btn-sm">
                                    Get in touch
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    include './includes/footer.php';
?>