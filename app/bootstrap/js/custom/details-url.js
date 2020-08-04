//setDetailsUrl();
GetUrl();

function setDetailsUrl() {
    var url = window.location.href
    document.getElementById('callbackurl').setAttribute("href", url);
    //alert(url);
}

function GetUrl() {
    var referrer = document.referrer;
    //alert(referrer);
    document.getElementById('callbackurl').setAttribute('value', url);
}