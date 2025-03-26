function create_service(event) {
    event.preventDefault();
    var formData = new FormData();

    const title = $('#title').val();
    const content = $('#content').val();
    const icon = $('#icon').val();

    if(title && content) {
        formData.append('title', title);
        formData.append('content', content);
        formData.append('icon', icon);
    
        fetch('../controllers/service-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Hello there!</strong> A simple success alert—check it out!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Hello there!</strong> A simple danger alert—check it out!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        event.preventDefault();
        console.log('error');
    }
}