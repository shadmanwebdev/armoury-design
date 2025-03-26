function check(el) {
    var cat = el.querySelector('.category-checkbox');
    if(cat.checked == false) {
        cat.checked = true;
        return;
    } else {
        cat.checked = false;
        return;
    }
}
function check2(el) {
    var cat = el.querySelector('.category-checkbox');
    cat.checked = true;
    return;
}
function openSettings() {
    closePopup();
    popup('cookie-settings-popup');
}
function denyCookies() {
    var formData = new FormData();
    formData.append('cookie_status', 'deny_all');

    fetch('./controllers/cookie-handler.php', {
        method: 'post',
        body: formData
    })
    .then(response => {
        return response.json();       
    })
    .then(response => {
        console.log(response);
        if(response == '0') {
            closePopup();
        }
    })
}
function customCookies() {
    var formData = new FormData();
    formData.append('cookie_status', 'custom');
    var necessary = document.getElementById('necessary');
    var functional = document.getElementById('functional');
    var analytic = document.getElementById('analytic');
    var ads = document.getElementById('ads');
    if(necessary.checked) {
        formData.append('necessary', '1');
    } else {
        formData.append('necessary', '0');
    }
    if(functional.checked) {
        formData.append('functional', '1');
    } else {
        formData.append('functional', '0');
    }
    if(analytic.checked) {
        formData.append('analytic', '1');
    } else {
        formData.append('analytic', '0');
    }
    if(ads.checked) {
        formData.append('ads', '1');
    } else {
        formData.append('ads', '0');
    }

    fetch('./controllers/cookie-handler.php', {
        method: 'post',
        body: formData
    })
    .then(response => {
        return response.json();       
    })
    .then(response => {
        console.log(response);
        if(response == '2') {
            closePopup();
        }
    })
}
function acceptCookies() {
    var formData = new FormData();
    formData.append('cookie_status', 'accept_all');

    fetch('./controllers/cookie-handler.php', {
        method: 'post',
        body: formData
    })
    .then(response => {
        return response.json();       
    })
    .then(response => {
        console.log(response);
        if(response == '1') {
            closePopup();
        }
    })
}