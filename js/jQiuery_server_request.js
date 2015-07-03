// JavaScript Document
$.ajaxSetup({
    url: "php/request_support.php",
    method: "POST"
});

var request = $.ajax({
    datatype: "html",
    data: {}
});

request.done(function(response){

});

request.fail(function(response){
    console.log("Error Response from server! The response is :" + response);
});