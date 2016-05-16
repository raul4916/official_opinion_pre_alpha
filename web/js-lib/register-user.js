/**
 * Created by raul4916 on 4/5/16.
 */
!function(){
    $.getScript("js-lib/tools.js");

    for(var i = 20; i<31;i++) {
        var ajax = createAjax();
        var userJson = {"username": "bot"+i, "password": "123", "email": "bot"+i+"@gmail.com"};
        var path = "json/user";
        var data = JSON.stringify(userJson);
        sendAjax(ajax, path, "POST", data);
    }

}();