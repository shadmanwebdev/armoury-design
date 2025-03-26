function validateContact(event) {
    event.preventDefault();
    var form = $('.contact-form')[0];
    var formData = new FormData(form);
    // Name
    var fnameValue = document.getElementById('fname').value;
    var fnameError = document.getElementById('fnameError');
    // Surname
    var lnameValue = document.getElementById('lname').value;
    var lnameError = document.getElementById('lnameError');
    // Subject
    var phoneValue = document.getElementById('phone').value;
    var phoneError = document.getElementById('phoneError');
    // Subject
    var subjectValue = document.getElementById('subject').value;
    var subjectError = document.getElementById('subjectError');
    // Email
    var emailValue = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    // Message
    var msgValue = document.getElementById('msg').value;
    var msgError = document.getElementById('msgError');



    // console.log(emailValue, fnameValue, lnameValue);

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && phoneValue && subjectValue && fnameValue && lnameValue) {
        emailError.innerHTML = '';
        fnameError.innerHTML = '';
        lnameError.innerHTML = '';
        phoneError.innerHTML = '';
        subjectError.innerHTML = '';
        $.ajax({
            url : './controllers/contact-handler',
            type: 'POST', 
            data : formData,
            async: false,
            cache : false,
            contentType: false,
            processData: false,
            success: function(response, textStatus, jqXHR) {
                console.log(response);
                if($.trim(response) == '1') {
                    var alert = document.getElementById('msg-response');
                    alert.innerHTML = "<div class='success'>Your message has been sent!</div>";
                } else {
                    var alert = document.getElementById('msg-response');
                    alert.innerHTML = "<div class='error'>There was an error.</div>";
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    } else {
        // Email
        if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            emailError.innerHTML = '';
        } else {
            if(!emailValue) {
                emailError.innerHTML = '<div>* Required</div>';
            } else {
                emailError.innerHTML = '<div>Please enter a valid email</div>';
            }
        }
        // First name
        if(fnameValue) {
            fnameError.innerHTML = '';
        } else {
            fnameError.innerHTML = '<div>* Required</div>';
        }
        // Last name
        if(lnameValue) {
            lnameError.innerHTML = '';
        } else {
            lnameError.innerHTML = '<div>* Required</div>';
        }
        // Phone
        if(phoneValue) {
            phoneError.innerHTML = '';
        } else {
            phoneError.innerHTML = '<div>* Required</div>';
        }
        // Subject
        if(subjectValue) {
            subjectError.innerHTML = '';
        } else {
            subjectError.innerHTML = '<div>* Required</div>';
        }
    }
}