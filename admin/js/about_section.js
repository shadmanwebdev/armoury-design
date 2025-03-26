function update_about_section(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_about_summary = $('#update_about_summary').val();
    const title = $('#title').val();
    const subtitle = $('#subtitle').val();
    const content = $('#content').val();
    const btn_text = $('#btn_text').val();
    const about_text_1 = $('#about_text_1').val();
    const about_text_2 = $('#about_text_2').val();
    const about_text_3 = $('#about_text_3').val();
    const about_text_4 = $('#about_text_4').val();
    const image = $('input#image')[0].files[0];

    if(update_about_summary) {
        formData.append('update_about_summary', update_about_summary);
        formData.append('title', title);
        formData.append('subtitle', subtitle);
        formData.append('content', content);
        formData.append('btn_text', btn_text);
        formData.append('about_text_1', about_text_1);
        formData.append('about_text_2', about_text_2);
        formData.append('about_text_3', about_text_3);
        formData.append('about_text_4', about_text_4);
        formData.append('image', image);
    
        fetch('../controllers/about-section-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> About section updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}
function update_about_page(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_about = $('#update_about').val();
    const title = $('#title').val();
    const content = $('#content').val();
    const btn_text = $('#btn_text').val();
    const image = $('input#image')[0].files[0];

    if(update_about) {
        formData.append('update_about', 'true');
        formData.append('title', title);
        formData.append('content', content);
        formData.append('btn_text', btn_text);
        formData.append('image', image);
    
        fetch('../controllers/about-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> About page updated!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}
