function popup(popEl) {
    var popup = document.getElementById(popEl);
    var popBg = document.getElementById('popBg');
    
    if(popup.classList.contains('hide_popup')) {
        popup.classList.remove('hide_popup');
        popup.classList.add('show_popup');
        if(popBg.classList.contains('light')) {
            popBg.classList.remove('light');
        }
        popBg.classList.add('dark');
    }
}
function hidePopupBg() {
    var popBg = document.getElementById('popBg');
    var popupNodelist = document.querySelectorAll('.popup');   
    for (let i = 0; i < popupNodelist.length; i++) {
        if(popupNodelist[i].classList.contains('show_popup')) {
            popupNodelist[i].classList.remove('show_popup');
            popupNodelist[i].classList.add('hide_popup');
            if(popBg.classList.contains('dark')) {
                popBg.classList.remove('dark');
            }
            popBg.classList.add('light');
        }
    }
}
function closePopup() {
    var popBg = document.getElementById('popBg');
    var popupNodelist = document.querySelectorAll('.popup');   
    for (let i = 0; i < popupNodelist.length; i++) {
        if(popupNodelist[i].classList.contains('show_popup')) {
            popupNodelist[i].classList.remove('show_popup');
            popupNodelist[i].classList.add('hide_popup');
            if(popBg.classList.contains('dark')) {
                popBg.classList.remove('dark');
            }
            popBg.classList.add('light');
        }
    }
}

popup('cookie_consent_popup');