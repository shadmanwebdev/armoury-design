
    <!-- FOOTER -->
    <footer class='footer-main'>
        <div class='footer-inner-div'>
            <div class='footer-row-wrapper'>
                <div class='footer-row' id='footer-row-1'>
                    <div class='footer-col' id='footer-col-1'>
                        <?php 
                            echo get_footer_logo();
                        ?>
                        <div class='socials'>
                            <div title='facebook' class='social' id='social-1'>
                                <a href="https://www.facebook.com/"></a>
                            </div>
                            <div class='social' id='social-2'>
                                <a href="https:/twitter.com"></a>
                            </div>
                            <div title='instagram' class='social' id='social-3'>
                                <a href="https://www.instagram.com/"></a>
                            </div>
                        </div>
                    </div>
                    <div class='footer-col' id='footer-col-2'>
                        <div class='title'>
                            Get Started
                        </div>
                        <div class='col-items'>
                            <a href='./disclaimer'>Disclaimer</a>
                            <a href='./terms-of-service'>Terms of Service</a>
                            <a href='./privacy-policy'>Privacy Policy</a>
                            <!-- <a href='./faq'>FAQ</a> -->
                        </div>
                    </div>
                    <div class='footer-col' id='footer-col-3'>
                        <div class='title'>
                            Links
                        </div>
                        <div class='col-items'>
                            <a href="./">Home</a>
                            <a href="./about">About</a>
                            <a href="./services">Services</a>
                            <a href="./contact">Contact</a>
                            <a href="./demos">Demos</a>
                        </div>
                    </div>
                    <div class='footer-col' id='footer-col-4'>
                        <div class='title'>
                            Contact Us
                        </div>
                        <div class='col-items'>
                            <li>A108 Adam Street</li>
                            <li>New York, NY 535022</li>
                            <li>United States</li>
                            <li>Phone: +1 5589 55488 55</li>
                            <li>Email: info@example.com</li>
                        </div>

                    </div>
                </div>
            </div>
            <div class='footer-row-wrapper'>
                <div class='footer-row' id='footer-row-2'>
                    <div class='footer-col' id='footer-col-1'>
                        <?= $settings->copyright_text() ; ?>
                    </div>                    
                    <div class='footer-col' id='footer-col-2'>
                        <?= $settings->contact() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    </div>
    <!-- MAIN END -->

    <!-- Footer -->
    <footer>
        <div class="footer-inner-div">
            <div class="footer-top">
                <?php 
                    echo get_footer_logo();
                ?>
                <div class='socials'>
                    <div title='facebook' class='social' id='social-1'>
                        <a href="https://www.facebook.com/DriftWerkGarage"></a>
                    </div>
                    <div title='instagram' class='social' id='social-3'>
                        <a href="https://www.instagram.com/driftwerk/"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class='footer-col' id='footer-col-1'>
                    <?= $settings->copyright_text() ; ?>
                </div>                    
                <div class='footer-col' id='footer-col-2'>
                    <?= $settings->contact() ; ?>
                </div>
            </div>
        </div>
    </footer>


</body>
</html>