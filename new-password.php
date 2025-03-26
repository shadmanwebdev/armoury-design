<?php
    include './includes/header.php';
?>


    <div class='bg-silver-300'>
        <?php
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            if(empty($selector) || empty($validator)) {
                echo 'Could not validate your request';
            } else {
                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {      
        ?> 
            <div class="content login-content">
                <form id="login-form" class="login-form" method='POST'>
                    <div id='msg-response'></div>
                    <h2 class="login-title">New Password</h2>
                    <input type="hidden" name="update_password_2" id="update_password_2" value="true">
                    <input type="hidden" name="selector" id="selector" value="<?php echo $selector; ?>">
                    <input type="hidden" name="validator" id="validator" value="<?php echo $validator; ?>">
                    <div class="form-group">
                        <div class="input-group-icon right">
                            <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                            <input class="form-control" type="password" name="password" id="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group-icon right">
                            <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                            <input class="form-control" type="password" name="repeat_password" id="repeat_password" placeholder="Repeat Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <span onclick='update_password(event)' class="btn btn-info btn-block" type="submit">Submit</span>
                    </div>
                </form>
            </div>
        <?php
                }
            }
        ?>
        <!-- BEGIN PAGA BACKDROPS-->
        <div class="sidenav-backdrop backdrop"></div>

        <!-- END PAGA BACKDROPS-->
        <!-- CORE PLUGINS -->
        <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
        <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- PAGE LEVEL PLUGINS -->
        <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
        <!-- CORE SCRIPTS-->
        <script src="assets/js/app.js" type="text/javascript"></script>
        <!-- PAGE LEVEL SCRIPTS-->
        <script type="text/javascript">
            $(function() {
                $('#login-form').validate({
                    errorClass: "help-block",
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true
                        }
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                });
            });
        </script>
    </div>




</body>

</html>