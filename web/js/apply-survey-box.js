!function() {
    $.getScript("js-lib/tools.js");
    const HTTP = 'http://';
    const HOSTNAME = "localhost";
    const PORT = "8000";
    const COMPLETE_HOST = HTTP + HOSTNAME + ':' + PORT;
    var surveyIDArray;
    var url = window.location.href;
    var numURL = strToInt(url);
    var surveysForPage;
    var ajax = createAjax();
    var path = "json/survey-page/"+numURL;
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4) {
            surveysForPage = JSON.parse(ajax.responseText);
            if (surveysForPage.response == "DOES NOT EXIST") {
                var div = createSurveySmallBox();
                $(".official-opinion-div").append(div.innerHTML);
                $(document).ready(function () {
                    $("#cButton").click(function () {
                        sendCreate();
                    });
                });
            }
            else {
                surveyIDArray = surveysForPage.response.surveyIDs;
                for (var i = 0; i < surveyIDArray.length; i++) {
                    ajax.onreadystatechange = function () {
                        path = "/json/get-surveys/" + surveyIDArray[i];
                        if ($(window).hostname == HOSTNAME) {
                            var div = displaySurveySmall(json.response);
                            $(".official-opinion-div").append(div.innerHTML);
                        }
                        else {
                            var div = outsidersDisplaySurveySmall(json.response);
                            $(".official-opinion-div").append(div.innerHTML);
                        }
                    }
                    sendAjax(ajax, path);
                }
            }
            var link = document.getElementById("official-link");
            link.parentNode.removeChild(link);
        }
    }
    sendAjax(ajax,path);
}();