function create_project(event) {
    event.preventDefault();
    var formData = new FormData();

    const create_project = $('#create_project').val();
    const project_name = $('#project_name').val();
    const start_date = $('#start_date').val();
    const end_date = $('#end_date').val();
    const project_status = $('#project_status').val();
    const assignee = $('#assignee').val();

    if(create_project && project_status) {
        formData.append('create_project', create_project);
        formData.append('project_name', project_name);
        formData.append('start_date', start_date);
        formData.append('end_date', end_date);
        formData.append('project_status', project_status);
        formData.append('assignee', assignee);
    
        fetch('../controllers/project-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> New project created!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Error!</strong> An error occured while submitting this form!</div></div>");
    }
}
function update_project(event) {
    event.preventDefault();
    var formData = new FormData();

    const update_project = $('#update_project').val();
    const project_id = $('#project_id').val();
    const project_name = $('#project_name').val();
    const start_date = $('#start_date').val();
    const end_date = $('#end_date').val();
    const project_status = $('#project_status').val();
    const assignee = $('#assignee').val();

    if(update_project && project_status) {
        formData.append('update_project', update_project);
        formData.append('project_id', project_id);
        formData.append('project_name', project_name);
        formData.append('start_date', start_date);
        formData.append('end_date', end_date);
        formData.append('project_status', project_status);
        formData.append('assignee', assignee);

        // console.log(project_name, start_date, end_date, project_status, assignee);
    
        fetch('../controllers/project-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Success!</strong> Project was updated!</div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Hello there!</strong> An error occured while submitting this form!</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(project_status) {
            
        }
        $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> An error occured while submitting this form!</div></div>");
    }
}