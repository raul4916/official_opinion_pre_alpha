/**
 * Created by raul4916 on 3/2/16.
 */
$.getScript("js-lib/tools.js");


const HTTP = 'http://';
const HOSTNAME = "localhost";
const PORT = "8000";
const COMPLETE_HOST = HTTP + HOSTNAME + ':' + PORT;

//Json needed
// {fid = int, username:"bla", "question":"blah", type = string of type(rating, multiple_choice, yes_no)
//   responses: [1,2,3], allow_comments : T/F, groups_allowed: string (ex: New_user), recommended:INT, boring:INT,reported:bool,tags:string, description:string}

function displaySurveySmall(json) {
    var mainDiv = $(document.createElement('div')).setAttribute('class', 'smallSurvey');
    var question = '<div id = question-div class = question><p class = question id = "question-text">' + json.question + '</p></div>';
    var answers = json.response;
    var answersHtml = '<form action="sendAnswer()">';
    for (var i = 0; i < answers.length; i++) {
        answersHtml += '<input type = "radio" name = "' + answers[i].toLowerCase() + '">' + answers[i] + '</input>';
    }
    answers += '</form>';
    var recommended = '<input type = "button" name = recommended value = "Recommended"/><p class = reviewCount >Count: ' + json.recommended + '</p>'
    var boring = '<input type =  "button" name = "boring" value = "Boring"/><p class = reviewCount >Count: ' + json.boring + '</p>'
    var reported = '<input type =  "button" name = "report" value = "Report"/>'
    var surveyID = '<input type = hidden name = "surveyID" value =' + json.fid + '/>'

    var review = '<form action="sendReview()">' + recommended + boring + reported + '</form>';

    var tags = '<p class = tags> Tags: ' + json.tags + '</p>'
    var details = '<div class = details>' + tags + '</div>'

    question + answersHtml + review + details
    mainDiv.innerHTML ='<form class = "survey">'+question + answersHtml + review + details + '</form>';
    return mainDiv;
    // add description later after testing the above
}

// json =  {fid = int, username:"bla", "question":"blah", type = string of type(rating, multiple_choice, yes_no)
//   responses: [1,2,3], allow_comments : T/F, groups_allowed: string (ex: New_user), recommended:INT, boring:INT,reported:bool,tags:string, description:string}
function outsidersDisplaySurveySmall(json) {
    var frame;
    if (!(frame = $(document).getElementsByClassName("smallSurveyOutsider")))
        frame = $(document).createElement("div").setAttribute("class", "smallSurveyOutsider");
    return $(".smallSurveyOutsider").html(displaySurveySmall(json));
}


function createSurveySmallBox() {
    var mainDiv = $(document.createElement("div").setAttribute("class", "smallCreateSurvey"));
    var question = '<div id = "cQuestionDiv" ><p id = cQuestionText>Question:</p><input type = "text" name = "question" placeholder="Why do you have question?"/></div>';
    var type = '<div id = "cQTypeDiv">' +
        '<input type="radio" id ="yes_no" value = "yes_no" name ="type" onclick="showResponse()" checked>Yes and No' +
        '<input type="radio" id ="multiple_choice" value = "type" name ="response" onclick="showResponse()">Multiple Choice' +
        '<input type="radio" id ="rating" value = "rating" name ="type" onclick="showResponse()">Rating' +
        '</div>';
    var preview = '<div id = "cPreviewDiv">' +

        'Preview:' +
        '<input type="radio" id = yes  checked>Yes' +
        '<input type="radio" id = no>No' +
        '</div>';
    var responses = '<div id = "cResponsesDiv">' +
        '</div>';
    var createButton = '<div id = cButton><input id = "testButton" type="button" name = "createButton" value = "Create"></div>';
    var options =
        '<div class = cOptions>' +
        '<div id = commentsAllowedDiv><input type="checkbox" name = "allow_comments" value=true checked>Allow Comments</div>' +
        '<div id = groupPermission >' +
        '<select name = "groups_allowed"  >' +
        '<option value = "all">All</option>' +
        '<option value = "members">Registered Users</option>' +
        '<option value = "senior_members">Trusted Users</option>' +
        '</select>' +
        '</div>' +
        '</div>';
    var bottomDiv = '<div class = "bottom">' + createButton +options+ '</div>';
    mainDiv.innerHTML ='<form class = "createSurvey">' + question + type + responses + preview + bottomDiv + '</form>';
    return mainDiv;
}
function sendCreate() {
    var ajax = createAjax();
    var inputs = $(".createSurvey").serializeArray();
    var jsonStr = "{"
    var path = "json/create-survey/"+strToInt(window.location.href);
    for(var i = 0; i<inputs.length; i++){
        var obj = inputs[i];
            jsonStr+='"'+obj.name+'":"'+obj.value+'",';

    }
    jsonStr += ' "website" : "'+window.location.href+'"}'
    ajax.onreadystatechange = function(){
        if(ajax.readyState == 4)
            alert(ajax.responseText);
    }
    sendAjax(ajax,path,"POST",jsonStr);
}

function showResponse() {
    var response = document.getElementById("cResponsesDiv");
    var preview = document.getElementById("cPreviewDiv");

    if(document.getElementById("yes_no").checked){
        var previewStr = 'Preview: <form>' +
            '<input type="radio" id = yes value = yes checked>Yes' +
            '<input type="radio" id = no value = no  >No' +
            '</form>';
        response.innerHTML = "";
        preview.innerHTML = previewStr;
    }
    if(document.getElementById("multi_choice").checked){
        var previewStr='<p>Preview: still need to finish</p>';
        var responses = 'Responses:' +
            '<form>' +
            '1.&nbsp <input type="text" id = yes name = response ><br>' +
            '2.&nbsp <input type="text" id = no name = response >' +
            '</form>'+
            '</div>';
        response.innerHTML = responses;
        preview.innerHTML = previewStr;
    }
    if(document.getElementById("rating").checked){
        var previewStr = 'Preview: <form>' +
            '<input type="radio" id = five value = 5 checked > 5' +
            '<input type="radio" id = four value = 4 > 4' +
            '<input type="radio" id = three value = 3 > 3' +
            '<input type="radio" id = two value = 2 > 2' +
            '<input type="radio" id = one value = 1 > 1' +
            '</form>'
        response.innerHTML = "";
        preview.innerHTML = previewStr;
    }

}
