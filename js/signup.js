// function sendMsg(formData) {

// }
function signup(event) {
    event.preventDefault();
    var form = $('.signup-form')[0];
    var formData = new FormData(form);
    // Name
    var fnameValue = document.getElementById('fname').value;
    var fnameError = document.getElementById('fnameError');
    // Surname
    var lnameValue = document.getElementById('lname').value;
    var lnameError = document.getElementById('lnameError');
    // Email
    var emailValue = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    // Phone
    var phoneValue = document.getElementById('phone').value;
    var phoneError = document.getElementById('phoneError');
    // Message
    var pwdValue = document.getElementById('pwd').value;
    var pwdError = document.getElementById('pwdError');



    // console.log(emailValue, fnameValue, lnameValue);

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) && fnameValue && lnameValue && mocValue && ((mocValue == 'phone' && phoneValue) || (mocValue == 'email') )) {
        fnameError.innerHTML = '';
        lnameError.innerHTML = '';
        emailError.innerHTML = '';
        phoneError.innerHTML = '';
        pwdError.innerHTML = '';

        $.ajax({
            url : './controllers/signup-handler',
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
                    alert.classList.add('alert') 
                    alert.innerHTML = "<div class='success'>Your message has been sent!</div>";
                } else {
                    var alert = document.getElementById('msg-response');
                    alert.classList.add('alert') 
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
        if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            emailError.innerHTML = '';
        } else {
            if(!emailValue) {
                emailError.innerHTML = '<div>* Required</div>';
            } else {
                emailError.innerHTML = '<div>Please enter a valid email</div>';
            }
        }
        if(fnameValue) {
            fnameError.innerHTML = '';
        } else {
            fnameError.innerHTML = '<div>* Required</div>';
        }
        if(lnameValue) {
            lnameError.innerHTML = '';
        } else {
            lnameError.innerHTML = '<div>* Required</div>';
        }
        // Method of Reply
        if(mocValue) {
            mocError.innerHTML = '';
        } else {
            mocError.innerHTML = '<div>* Required</div>';
        }
        // Phone
        if(mocValue) {
            if(mocValue == 'phone') {
                if(phoneValue) {
                    phoneError.innerHTML = '';
                } else {
                    phoneError.innerHTML = '<div>* Required</div>';
                }
            } else if(mocValue == 'email') {
                phoneError.innerHTML = '';
            }
        }
    }
}

function darkFont(id) {
    var el = document.getElementById(id);
    el.style.color = '#000';
}