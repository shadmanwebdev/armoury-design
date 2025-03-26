function create_demo(event) {
    event.preventDefault();
    var formData = new FormData();

    const create_demo = $('#create_demo').val();
    const title = $('#title').val();
    const tags = $('#tags').val();
    const link = $('#link').val();
    const thumbnail = $('input#image')[0].files[0];

    if(create_demo) {
        formData.append('create_demo', create_demo);
        formData.append('title', title);
        formData.append('tags', tags);
        formData.append('link', link);
        formData.append('image', thumbnail);
    
        fetch('../controllers/demo-handler.php', {
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
function update_demo(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_demo = $('#update_demo').val();
    const demo_id = $('#demo_id').val();
    const title = $('#title').val();
    const tags = $('#tags').val();
    const link = $('#link').val();
    const thumbnail = $('input#image')[0].files[0];

    if(update_demo) {
        formData.append('update_demo', update_demo);
        formData.append('demo_id', demo_id);
        formData.append('title', title);
        formData.append('tags', tags);
        formData.append('link', link);
        formData.append('image', thumbnail);
    
        fetch('../controllers/demo-handler.php', {
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