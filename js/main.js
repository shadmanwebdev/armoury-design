function scroll_to_element(id, event) {
    event.preventDefault();
    var element = document.getElementById(id);
    if(window.innerWidth > 900) {
        element.scrollIntoView({ behavior: 'smooth', block: "center", inline: "nearest"});
    } else {
        element.scrollIntoView({ behavior: 'smooth', block: "start", inline: "nearest"});
    }
}
function get_page() {
    var path = window.location.pathname;
    var page = path.split("/").pop();
    return page;
}
function page_params() {
    // Page Parameters
    const urlParams = new URLSearchParams(window.location.search);
    for (const [key, value] of urlParams) {
        if(key == 'id') {
            var p = value;
        }
    }
}
function nav_scroll() {
    var page = get_page();
    window.onscroll = function() {
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        var navOuterNodelist = document.querySelectorAll('.nav-outer');
        var navInner = document.querySelectorAll('.nav-inner');
        // If page is home page
        if(page == '') {
            if(scrollTop > 200) {
                navOuterNodelist.forEach(el => {
                    if(!el.classList.contains('static-nav')) {
                        el.classList.remove('d-bg');
                        el.classList.add('w-bg');
                    }
                });                
                // navSpansAll.forEach(element => {
                //     element.style.backgroundColor = "#000";
                // });
            } else {
                navOuterNodelist.forEach(el => {
                    if(!el.classList.contains('static-nav')) {
                        el.classList.remove('w-bg');
                        el.classList.add('d-bg');
                    }
    
                    // navSpansAll.forEach(element => {
                    //     element.style.backgroundColor = "#fff";
                    // });
                });
            }
        } else {
            if(scrollTop > 200) {
                navOuterNodelist.forEach(el => {
                    if(!el.classList.contains('static-nav')) {
                        el.classList.add('w-bg');
                    }
                });                
                // navSpansAll.forEach(element => {
                //     element.style.backgroundColor = "#000";
                // });
            } else {
                navOuterNodelist.forEach(el => {
                    if(!el.classList.contains('static-nav')) {
                        el.classList.remove('w-bg');
                    }
                });  
            }
        }

        if(scrollTop > 200) {
            navInner.forEach(el => {
                el.classList.add('shrink');
            });
        } else {
            navInner.forEach(el => {
                el.classList.remove('shrink');
            });
        }
    };
}

function numInputs() {
    var numInps = document.querySelectorAll('input[type=number]');
    var invalidChars = ["-", "+", "e"];
    numInps.forEach(el => {
        el.addEventListener("keydown", function(e) {
            if (invalidChars.includes(e.key)) {
                e.preventDefault();
            }
        });
    });
}
numInputs();

nav_scroll();

function hideCards() {
    var cardNodelist = document.querySelectorAll('.form-card');   
    for (let i = 0; i < cardNodelist.length; i++) {
        cardNodelist[i].style.position = 'absolute';
        cardNodelist[i].style.top = 0;
        cardNodelist[i].style.zIndex = -10;
        cardNodelist[i].style.opacity = 0;
    }
}

function showCards() {
    document.getElementById('form-card-1').style.position = 'static';
    document.getElementById('form-card-1').style.opacity = 1;
}
function prevCard(i) {
    hideCards();
    document.getElementById('form-card-'+i).style.position = 'static';
    document.getElementById('form-card-'+i).style.opacity = 1;
}
function nextCard(i) {
    hideCards();
    document.getElementById('form-card-'+i).style.position = 'static';
    document.getElementById('form-card-'+i).style.opacity = 1;
}


