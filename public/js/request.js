function createRequest() {
    var Request = false;

    if (window.XMLHttpRequest) {
        Request = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        try {
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (CatchException) {
            Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }
    if (!Request) {
        console.log("Невозможно создать XMLHttpRequest");
    }
    return Request;
}
function sendRequest(method, path, args, handler) {
    var Request = createRequest();
    if (!Request) {
        return;
    }
    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            handler(Request);
        }
    }
    if (method.toLowerCase() == "get" && args.length > 0)
        path += "?" + args;

    Request.open(method, path, true);

    if (method.toLowerCase() == "post") {
        Request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");
        Request.send(args);
    }
    else {
        Request.send(null);
    }
}


