const theme = document.getElementById("theme");
const lighttheme = document.getElementById("lighttheme");


function CheckCurrentTheme() {
    if (getCookieValue("themevalue") == null) {
        setCookie("themevalue", 1);
    }

    var basePath = location.pathname;
    var imagesPath;

    switch (basePath) {
        case '/Code-Ju1/':
        case '/Code-Ju1':
            imagesPath = "/Code-Ju1/images/";
            break;
        case '/':
        case '':
            imagesPath = "/images/";
            break;
        default:
            if (basePath.startsWith('/Code-Ju1/pages/') || basePath === '/pages' || basePath === '/pages/') {
                imagesPath = "../images/";
            } else if (basePath.startsWith('/pages/')) {
                imagesPath = "/images/";
            } else {
                imagesPath = basePath + "/images/";
            }
            break;
    }

    if (getCookieValue("themevalue") == 0) {
        theme.setAttribute("src", imagesPath + "light-off.png");
        lighttheme.setAttribute("disabled", "disabled");
    } else {
        theme.setAttribute("src", imagesPath + "light-on.png");
        lighttheme.removeAttribute("disabled");
    }
}


function getRelativePath(path) {
    var segments = path.split('/');
    segments.pop();
    return segments.join('/') + '/';
}



CheckCurrentTheme();

function WarnUser() {
    const button = document.getElementById('Warn');
    if (confirm("Are you sure you want to delete this code?")) { // Make prompt to confirm deletion of every single file
        button.setAttribute('name', 'deletecode'); // Change the name of the form to match the PHP code
        return true; // Yes delete all
    }
    else {
        return false; // No cancel
    }
}

function setCookie(cookieName, cookieValue) {
    var expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + 10);

    var cookie = encodeURIComponent(cookieName) + '=' + encodeURIComponent(cookieValue);
    cookie += '; expires=' + expirationDate.toUTCString();
    cookie += '; max-age=' + (10 * 365 * 24 * 60 * 60);
    cookie += '; path=/';
    cookie += '; SameSite=None';
    cookie += '; Secure';

    document.cookie = cookie;
}

function getCookieValue(cookieName) {
    var cookies = document.cookie.split(';');

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();

        if (cookie.indexOf(cookieName + '=') === 0) {
            return decodeURIComponent(cookie.substring(cookieName.length + 1));
        }
    }

    return null;
}

function ChangeTheme() {

    if (getCookieValue("themevalue") == 0) {
        setCookie("themevalue", 1);
    }
    else {
        setCookie("themevalue", 0);
    }
    CheckCurrentTheme();

}