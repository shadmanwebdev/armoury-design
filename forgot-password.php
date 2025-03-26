<?php
    include './includes/header.php';
?>

    <div class='bg-silver-300'>

        <div class="content login-content">
            <form id="forgot-form" class="forgot-form" method='POST'>
                <div id='msg-response'></div>
                <input type="hidden" name='forgot_password' id='forgot_password' value='true'>
                <h3 class="m-t-10 m-b-10">Forgot password</h3>
                <p class="m-b-20">Enter your email address below and we'll send you password reset instructions.</p>
                <div class="form-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                    <span onclick='forgot_password(event)' class="btn btn-info btn-block" type="submit">Submit</span>
                </div>
            </form>
        </div>
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
                $('#forgot-form').validate({
                    errorClass: "help-block",
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
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