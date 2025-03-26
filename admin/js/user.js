function update_pwd(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_pwd = $('#update_pwd').val();
    const current_password = $('#current_password').val();
    const new_password = $('#new_password').val();
    const repeat_password = $('#repeat_password').val();
    // console.log(update_pwd, current_password, new_password, repeat_password);
    if(
        update_pwd && current_password && new_password && repeat_password
    ) {
        formData.append('update_password', update_pwd);
        formData.append('current_password', current_password);
        formData.append('new_password', new_password);
        formData.append('repeat_password', repeat_password);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Password updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(current_password) {
            $('#current_password_error').html('');
        } else {
            $('#current_password_error').html('<div>Field cannot be blank</div>');
        }
        if(new_password) {
            $('#new_password_error').html('');
        } else {
            $('#new_password_error').html('<div>Field cannot be blank</div>');
        }
        if(repeat_password) {
            $('#repeat_password_error').html('');
            if(new_password != repeat_password) {
                $('#repeat_password_error').html('<div>Passwords don\'t match</div>');
            }
        } else {
            $('#repeat_password_error').html('<div>Field cannot be blank</div>');
        }

    }
}
function email_setup(event) {
    event.preventDefault();
    var formData = new FormData();

    const email_setup = $('#email_setup').val();
    const smtp_host = $('#smtp_host').val();
    const smtp_encryption = $('#smtp_encryption').val();
    const smtp_port = $('#smtp_port').val();
    const username = $('#username').val();
    const password = $('#password').val();
    
    if(
        email_setup
    ) {
        formData.append('email_setup', email_setup);
        formData.append('smtp_host', smtp_host);
        formData.append('smtp_encryption', smtp_encryption);
        formData.append('smtp_port', smtp_port);
        formData.append('username', username);
        formData.append('password', password);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> SMTP details updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        // console.log(email_setup, smtp_host, smtp_encryption, smtp_port, username, password);
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
    }
}
function update_public_info(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_public_info = $('#update_public_info').val();
    const username = $('#username').val();
    const bio = $('#bio').val();
    const photo = $('input#image')[0].files[0];

    console.log(update_public_info, username, bio, photo);
    
    if(
        update_public_info
    ) {
        formData.append('update_public_info', update_public_info);
        formData.append('username', username);
        formData.append('bio', bio);
        formData.append('photo', photo);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response1').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Public information updated!</div></div>");
            } else {
                $('#msg-response1').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        // console.log(email_setup, smtp_host, smtp_encryption, smtp_port, username, password);
        $('#msg-response1').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
    }
}
function update_private_info(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_private_info = $('#update_private_info').val();
    const fname = $('#fname').val();
    const lname = $('#lname').val();
    const email = $('#email').val();

    console.log(update_private_info, fname, lname, email);
    
    if(
        update_private_info
    ) {
        formData.append('update_private_info', update_private_info);
        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('email', email);


        fetch('../controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response2').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Private information updated!</div></div>");
            } else {
                $('#msg-response2').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        // console.log(email_setup, smtp_host, smtp_encryption, smtp_port, username, password);
        $('#msg-response2').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error!</div></div>");
    }
}