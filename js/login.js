function login(event) {
    event.preventDefault();
    var formData = new FormData();

    const email = $('#email').val();
    const password = $('#password').val();

    formData.append('email', email);
    formData.append('password', password);

    if(
        email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && password
    ) {
        fetch('./controllers/login-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                window.location.href = './admin/index.php'
                // $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New FAQ created!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> Incorrect Email or Password!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#email').removeClass('invalid');
            $('#emailError').html('');
        } else {
            $('#email').addClass('invalid');
            if(email) {
                $('#emailError').html('<div>Please enter a valid email</div>');
            } else {
                $('#emailError').html('<div>Email cannot be blank</div>');
            }
        }
        if(password) {
            $('#pwdError').html('');
            $('#pwdError').removeClass('invalid');
        } else {
            $('#pwdError').addClass('invalid');
            $('#pwdError').html('<div>Password cannot be blank</div>');
        }
    }
}
function forgot_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const emailValue = $('#email').val();

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {

        formData.append('forgot_password', 'true');
        formData.append('email', emailValue);
    
        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            var alert = document.getElementById('msg-response');

            if($.trim(response) == '1') {
                alert.innerHTML = "<div class='success'>Reset email sent</div>";
            } else if ($.trim(response) == '2') {
                alert.innerHTML = "<div class='error'>This email is not registered</div>";
            } else {
                alert.innerHTML = "<div class='error'>There was an error.</div>";
            }
        })
        .catch( err => console.log(err));
    }
}
function update_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const selector = $('#selector').val();
    const validator = $('#validator').val();
    const new_password = $('#password').val();
    const repeat_password = $('#repeat_password').val();
    
    if(new_password && repeat_password && new_password == repeat_password) {
        
        formData.append('update_password_2', 'true');
        formData.append('selector', selector);
        formData.append('validator', validator);
        formData.append('new_password', new_password);
        formData.append('repeat_password', repeat_password);
    
        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            var alert = document.getElementById('msg-response');

            if($.trim(response) == '1') {
                alert.innerHTML = "<div class='success'>Password updated</div>";
            } else if ($.trim(response) == '2') {
                alert.innerHTML = "<div class='error'>Passwords don't match</div>";
            } else {
                alert.innerHTML = "<div class='error'>There was an error.</div>";
            }
            // console.log(response);
        })
        .catch( err => console.log(err));
    } else if (empty(new_password) || empty(repeat_password)) {
        if(empty(new_password)) {
            $('#new_password_error').html("<div>Field cannot be empty</div>");
        }
        if(empty(repeat_password)) {
            $('#repeat_password_error').html("<div>Field cannot be empty</div>");
        }
    } else if (new_password != repeat_password) {
        $('#repeat_password_error').html("<div>Passwords don't match</div>");
    }
}