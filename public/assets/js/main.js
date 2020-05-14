


function closeLGPD()
{
    var d = new Date();
    d.setTime(d.getTime() + (30 * 24* 60 * 60 * 1000));
    document.cookie = "lgpd=ok;expires=" + d.toUTCString() + "; path=/;";
    $("#lgpd").fadeOut(1000);
    $("#lgpd").addClass("sr-only");
}

function getCookie(name) {
    var cookies = document.cookie;
    var prefix = name + "=";
    var begin = cookies.indexOf("; " + prefix);

    if (begin == -1) {

        begin = cookies.indexOf(prefix);

        if (begin != 0) {
            return null;
        }

    } else {
        begin += 2;
    }

    var end = cookies.indexOf(";", begin);

    if (end == -1) {
        end = cookies.length;
    }

    return unescape(cookies.substring(begin + prefix.length, end));
}

function deleteCookie(name) {
    if (getCookie(name)) {
           document.cookie = name + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    }
}

