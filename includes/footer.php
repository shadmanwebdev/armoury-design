        <!-- Footer -->
        <footer>
            <div class="footer-inner-div">
                <div class="footer-top">
                    <?php 
                        echo get_footer_logo();
                    ?>
                    <div class='socials'>
                        <div title='facebook' class='social' id='social-1'>
                            <a href="https://www.facebook.com/armourydesign">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                        <div title='instagram' class='social' id='social-2'>
                            <a href="https://www.instagram.com/armourydesign/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class='footer-col' id='footer-col-1'>
                        <?= $settings->copyright_text() ; ?>
                    </div>                    
                    <!-- <div class='footer-col' id='footer-col-2'> -->
                        
                            <!-- $settings->contact() ;  -->
                        
                    <!-- </div> -->
                </div>
            </div>
        </footer>

    </div>
    <!-- MAIN END -->




</body>
</html>