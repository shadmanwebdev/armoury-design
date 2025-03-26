

function update_home(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_top_section = $('#update_top_section').val();
    const title = $('#title').val();
    const subtitle = $('#subtitle').val();
    const logo_subtitle = $('#logo_subtitle').val();
    const btn_text = $('#btn_text').val();
    const logo = $('input#image')[0].files[0];
    const background_image = $('input#background_image')[0].files[0];
    // console.log(background_image);

    if(update_top_section) {
        formData.append('update_top_section', update_top_section);
        formData.append('title', title);
        formData.append('subtitle', subtitle);
        formData.append('logo_subtitle', logo_subtitle);
        formData.append('btn_text', btn_text);
        formData.append('logo', logo);
        formData.append('background_image', background_image);

        fetch('../controllers/home-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();   
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Home page updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> An error occured while submitting this form!</div></div>");
    }

}