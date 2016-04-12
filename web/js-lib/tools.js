/**
 * Created by raul4916 on 4/5/16.
 */

const HTTP = 'http://';
const HOSTNAME = "localhost";
const PORT = "8000";
const COMPLETE_HOST = HTTP + HOSTNAME + ':' + PORT;


function getJson(path,response,http_type,data,state) {
    var httpRequest;
    if(http_type == undefined){
        http_type="GET"
    }
    if (state == undefined) {
        state = true;
    }
    try {
        httpRequest = new XMLHttpRequest();
    } catch (e) {
        try {
            // IE 5 and IE6
            httpRequest = new XMLHttpRequest();
        } catch (e) {
            alert("Browser not supported");
        }
    }
    httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4) {
            response.response = JSON.parse(httpRequest.responseText).response;
            response.type = httpRequest.responseType;
        }
    }
    if (path.charAt(0) != '/') {
        path = "/" + path;
    }
    var url = COMPLETE_HOST + path
    //var url = $(window).location.protocol + "//" + $(window).location.hostname + path;
    httpRequest.open(http_type, url, state);
    if(data == undefined)
        httpRequest.send();
    else
        httpRequest.send(data);
}

function createAjax(){
    var httpRequest;
    try {
        httpRequest = new XMLHttpRequest();
    } catch (e) {
        try {
            // IE 5 and IE6
            httpRequest = new ActiveXObject();
        } catch (e) {
            alert("Browser not supported");
        }
    }
    return httpRequest;
}

function sendAjax(ajax,path,http_type,data,state){
    if(http_type == undefined){
        http_type="GET"
    }
    if (state == undefined) {
        state = true;
    }
    if (path.charAt(0) != '/') {
        path = "/" + path;
    }
    var url = COMPLETE_HOST + path;
    ajax.open(http_type, url, state);
    if(data == undefined) {
        ajax.send();
    }
    else {
        ajax.setRequestHeader("Content-Type", "application/json");
        ajax.send(data);
    }
}

function strToInt(str){
    var newStr = "";
    for (var i = 0; i < str.length; i++) {
        newStr += str.charCodeAt(i);
    }
    return newStr;
}