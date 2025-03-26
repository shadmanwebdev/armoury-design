var page = get_page();
if(page == 'get-a-quote') {
    hideCards();
    showCards();
}

function get_a_quote(event) {
    event.preventDefault();
    var formData = new FormData();

    const create_quote = $('#create_quote').val();

    const fname = $('#fname').val();
    const lname = $('#lname').val();
    const email = $('#email').val();
    const phone = $('#phone').val();

    const pitch = $('#pitch').val();
    const key_val = $('#key_val').val();
    const future = $('#future').val();
    const competitors = $('#competitors').val();
    const diff = $('#diff').val();
    // console.log(pitch, key_val, future, competitors, difference);
    
    const goals = $('#goals').val();
    const defsuccess = $('#defsuccess').val();
    const avoidfail = $('#avoidfail').val();
    const leastfavsites = $('#leastfavsites').val();
    // console.log(goals, defsuccess, avoidfail, leastfavsites);
    
    const audience = $('#audience').val();
    const curaudience = $('#curaudience').val();
    const information = $('#information').val();
    // console.log(audience, curaudience, information);
    
    const website_url = $('#website_url').val();
    const qualities = $('#qualities').val();
    const tochange = $('#tochange').val();
    const deadline_budget = $('#deadline_budget').val(); 
    // console.log(url, qualities, tochange, deadline_budget);

    /*
        pitch && key_val && future && competitors && difference &&
        goals && defsuccess && avoidfail && leastfavsites &&
        audience && curaudience && information &&
        website_url && qualities && tochange && deadline_budget
    */
    /*
        pitchError, keyvalError, futureError, competitorsError, differenceError
        goalsError, defsuccessError, avoidfailError, leastfavsitesError
        audienceError, curaudienceError, informationError
    */
    
    if(
        create_quote && fname && lname && email && phone
    ) {
        formData.append('create_quote', create_quote);

        formData.append('fname', fname);
        formData.append('lname', lname);
        formData.append('email', email);
        formData.append('phone', phone);

        formData.append('pitch', pitch);
        formData.append('key_val', key_val);
        formData.append('future', future);
        formData.append('competitors', competitors);
        formData.append('diff', diff);

        formData.append('goals', goals);
        formData.append('defsuccess', defsuccess);
        formData.append('avoidfail', avoidfail);
        formData.append('leastfavsites', leastfavsites);

        formData.append('audience', audience);
        formData.append('curaudience', curaudience);
        formData.append('information', information);
        
        formData.append('website_url', website_url);
        formData.append('qualities', qualities);
        formData.append('tochange', tochange);
        formData.append('deadline_budget', deadline_budget);

        if($('#menu').is(":checked")){
            formData.append('menu', '1');
        }
        if($('#responsive').is(":checked")){
            formData.append('responsive', '1');
        }
        if($('#booking').is(":checked")){
            formData.append('booking', '1');
        }
        if($('#blog').is(":checked")){
            formData.append('blog', '1');
        }
        if($('#video').is(":checked")){
            formData.append('video', '1');
        }
        if($('#chat').is(":checked")){
            formData.append('chat', '1');
        }
        if($('#social_media').is(":checked")){
            formData.append('social_media', '1');
        }
        if($('#contact_form').is(":checked")){
            formData.append('contact_form', '1');
        }
        if($('#other').is(":checked")){
            formData.append('other', '1');
        }
        if($('#photo_galleries').is(":checked")){
            formData.append('photo_galleries', '1');
        }
        if($('#open_hours').is(":checked")){
            formData.append('open_hours', '1');
        }
    
        fetch('./controllers/quote-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            console.log(response);
            if($.trim(response) == '1') {
                window.location.href = './thank-you';
                // $('#msg-response').html("<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Hello there!</strong> A simple success alert—check it out!</div></div>");
            } else {
                $('#msg-response').html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><div class='alert-message'><strong>Failed!</strong> There was an error.</div></div>");
            }
        })
        .catch( err => console.log(err));
    } else {
        if(fname) {
            $('#fnameError').html('');
            $('#fnameError').removeClass('invalid');
        } else {
            $('#fnameError').addClass('invalid');
            $('#fnameError').html('<div>First name cannot be blank</div>');
        }
        if(lname) {
            $('#lnameError').html('');
            $('#lnameError').removeClass('invalid');
        } else {
            $('#lnameError').addClass('invalid');
            $('#lnameError').html('<div>Last name cannot be blank</div>');
        }
        if(phone) {
            $('#phoneError').html('');
            $('#phoneError').removeClass('invalid');
        } else {
            $('#phoneError').addClass('invalid');
            $('#phoneError').html('<div>Phone cannot be blank</div>');
        }
        if(email && email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            $('#emailError').html('');
        } else {
            if(email) {
                $('#emailError').html('<div>Please enter a valid email</div>');
            } else {
                $('#emailError').html('<div>Email cannot be blank</div>');
            }
        }
    }
}

function quick_quote(event) {
    event.preventDefault();

    var price = 0;

    if(
        ($('#radio-1a').is(":checked") || $('#radio-1b').is(":checked")) &&
        ($('#radio-2a').is(":checked") || $('#radio-2b').is(":checked") || $('#radio-2c').is(":checked")) &&
        ($('#radio-3a').is(":checked") || $('#radio-3b').is(":checked")) &&
        $('#pages').val()
    ) {
        $('#form-card-input-group-1').removeClass('error-input');
        $('#form-card-input-group-2').removeClass('error-input');
        $('#form-card-input-group-3').removeClass('error-input');
        $('#form-card-input-group-4').removeClass('error-input');
        
        var pages = $('#pages').val();
        if(pages == 1) {
            price += 100;
        } else {
            price += 100 + ((pages-1) * 70);
        }
        if($('#radio-1a').is(":checked")){
            price += 80;
        } else if($('#radio-1b').is(":checked")){   
            price += 100;
        }
    
        if($('#radio-2a').is(":checked")){
            price += 0;
        } else if($('#radio-2b').is(":checked")){   
            price += 80;
        } else if($('#radio-2c').is(":checked")){   
            price += 120;
        }
    
        if($('#radio-3a').is(":checked")){
            price += 0;
        } else if($('#radio-3b').is(":checked")){   
            price += 150;
        }

        // console.log(price);
        $('#msg-response').html("<div class='total'><span>Total: </span><span>&euro;"+price+"</span></div>");      
    } else {
        if($('#radio-1a').is(":checked") || $('#radio-1b').is(":checked")){
            // $('#radio1-error').html('');
            $('#form-card-input-group-1').removeClass('error-input');
        } else {
            // $('#radio1-error').html('<div>Required</div>');      
            $('#form-card-input-group-1').addClass('error-input');
        }
        if($('#pages').val()){
            $('#form-card-input-group-2').removeClass('error-input');
        } else {
            $('#form-card-input-group-2').addClass('error-input');
        }
        if($('#radio-2a').is(":checked") || $('#radio-2b').is(":checked") || $('#radio-2c').is(":checked")){
            $('#form-card-input-group-3').removeClass('error-input');
        } else {
            $('#form-card-input-group-3').addClass('error-input');
        }
        if($('#radio-3a').is(":checked") || $('#radio-3b').is(":checked")){
            $('#form-card-input-group-4').removeClass('error-input');
        } else {
            $('#form-card-input-group-4').addClass('error-input');
        }

    }


}