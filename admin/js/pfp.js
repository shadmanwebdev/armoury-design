// var remove_btn = document.getElementById('remove_btn');
var preview_img = document.getElementById('pfp-img-preview');
var preview_img_src = document.getElementById('pfp-img-preview').src;


function fireButton(event) {
    event.preventDefault();
    document.getElementById('image').click();
}
function readPfpURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pfp-img-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#image").change(function(){
    readPfpURL(this);
});
