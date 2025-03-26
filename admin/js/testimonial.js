function create_testimonial(event) {
    event.preventDefault();
    var formData = new FormData();

    const create_testimonial = $('#create_testimonial').val();
    const fullname = $('#fullname').val();
    const profession = $('#profession').val();
    const photo = $('input#image')[0].files[0];

    if(create_testimonial) {
        formData.append('create_testimonial', create_testimonial);
        formData.append('fullname', fullname);
        formData.append('profession', profession);
        formData.append('photo', photo);
    
        fetch('../controllers/testimonial-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New demo created!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}
function update_testimonial(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_testimonial = $('#update_testimonial').val();
    const testimonial_id = $('#testimonial_id').val();
    const fullname = $('#fullname').val();
    const profession = $('#profession').val();
    const photo = $('input#image')[0].files[0];

    if(update_testimonial) {
        formData.append('update_testimonial', update_testimonial);
        formData.append('testimonial_id', testimonial_id);
        formData.append('fullname', fullname);
        formData.append('profession', profession);
        formData.append('photo', photo);
    
        fetch('../controllers/testimonial-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Demo updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}