function update_contact_info(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_contact_info = $('#update_contact_info').val();
    const addr = $('#addr').val();
    const phone = $('#phone').val();
    const email = $('#email').val();

    if(update_contact_info) {
        formData.append('update_contact_info', update_contact_info);
        formData.append('addr', addr);
        formData.append('phone', phone);
        formData.append('email', email);
    
        fetch('../controllers/contact-info-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New FAQ created!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}
