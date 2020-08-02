document.getElementById('logoutx').addEventListener('click', setLogoutUrl);

function setLogoutUrl() {
    var url = $(location).attr("href");
    let x = url.split('?');
    if (x.length > 1) {
        let logoutbaseurl = x[0] + '?logout';
        //alert(logoutbaseurl);
        document.getElementById('logoutx').setAttribute("href", logoutbaseurl);
    } else {
        let logoutbaseurl = x + '?logout';
        //alert(logoutbaseurl);
        document.getElementById('logoutx').setAttribute("href", logoutbaseurl);
    }
}