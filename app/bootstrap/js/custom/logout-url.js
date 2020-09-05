let logoutBTN = document.getElementById('logoutx')
let takeMeHome = document.getElementById('logouty')

logoutBTN.addEventListener('click', setLogoutUrl(logoutBTN))
takeMeHome.addEventListener('click', setLogoutUrl(takeMeHome))

function setLogoutUrl(DOMelement) {
    var url = $(location).attr("href");
    let x = url.split('?');
    if (x.length > 1) {
        let logoutbaseurl = x[0] + '?logout';
        //alert(logoutbaseurl);
        //document.getElementById('logoutx').setAttribute("href", logoutbaseurl);
        DOMelement.setAttribute("href", logoutbaseurl);
    } else {
        let logoutbaseurl = x + '?logout';
        //alert(logoutbaseurl);
        //document.getElementById('logoutx').setAttribute("href", logoutbaseurl);
        DOMelement.setAttribute("href", logoutbaseurl);
    }
}