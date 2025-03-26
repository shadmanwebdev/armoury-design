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
function pop(node) {
    return confirm("Are you sure you want to delete this? Click OK to continue or CANCEL to quit.");
}