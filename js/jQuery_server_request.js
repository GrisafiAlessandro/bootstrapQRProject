// JavaScript Document
/*
	typeRequest -> search / document / allDocuments / user
 	search -> type & pattern
	document -> ID_Document
	allDocuments -> ID_User
	user -> ID_User	
//*//*

var idDoc = "o43850350059u460erghihehihjiju0940";
var idUser = "rnhegerlfoherloli";
var searchType = "gte";
var pattern = "ciao";

*/

$.ajaxSetup({
    url: "php/request_support.php",
    method: "POST"
});

/** SEARCH FUNCTIONS */
function makeSearch(searchType,pattern,idUser)
{
	var request_search = $.ajax({
		datatype: "html",
		data: { "typeRequest" : "search",
				"type" : searchType, 
				"pattern" : pattern, 
				"ID_User" : idUser 
		}		
	});
	request_search.done(function (response) {
		$("div#searchResponse").empty().html(response);
	});
	request_search.fail(function(response){
		$("div#searchResponse").empty().html('<div class="search_list_item">Nessun risultato prodotto</div>');
		console.log("Error Response from server! The response is :" + response);
	});
}

/** REQUEST DOCUMENT  */
function getDocumentFromServer(idDocument) {	
	var request_Document = $.ajax({
		datatype: "html",
		data: { "typeRequest" : "document", "ID_Document" : idDocument }
	});
	
	//* risposta andata con fine positivo
	request_Document.done(function(response) {
		if(-1 == response.search("Errore"))	{
			$("section#sectionInfoDocumento").empty().html(response);
		}	
		else {
			$(document).html(response);
		}	
	});
	
	// Se Fallisce la richiesta
	request_Document.fail(function(response) {
		console.log("Error Response from server! The response is :" + response);
		alert("Errore connessione al server! Le chiediamo di riprovare..");
	});
};

/** REQUEST DOCUMENT IMAGE/PDF  */
function getImgFromServer(idDocument) {	
	var request_img = $.ajax({
		datatype: "html",
		data: { "typeRequest" : "img", "ID_Document" : idDocument }
	});
	
	//* risposta andata con fine positivo
	request_img.done(function(response) {
		if(-1 == response.search("Errore"))	{
			$("section#sectionImgDocumento").empty().html(response);
		}	
		else {
			$(document).html(response);
		}	
	});
	
	// Se Fallisce la richiesta
	request_img.fail(function(response) {
		console.log("Error Response from server! The response is :" + response);
		alert("Errore connessione al server! Le chiediamo di riprovare..");
	});
};

/* REQUEST DOCUMENT LIST */
function getDocumentListFromServer(idUser) {
	var request_documentList = $.ajax({
		datatype: "html",
		data: { "typeRequest" : "allDocuments", "ID_User" : idUser}
	});
	
	//* risposta andata con fine positivo
	request_documentList.done(function(response) { 
		if(-1 == response.search("Errore"))	{
			$("aside#containerAside").empty().html(response);
		}	
		else {
			$(document).html(response);
		}
	});
	
	// Se Fallisce la richiesta
	request_documentList.fail(function(response) {
		console.log("Error Response from server! The response is :" + response);
		alert("Errore connessione al server! Le chiediamo di riprovare..");
	});
}

/* REQUEST COMPLETE USER + DOCUMENT LIST */
function getUserFromServer(idUser) {
	var request_user = $.ajax({
		datatype: "html",
		data: { "typeRequest" : "user", "ID_User" : idUser}
	});
	
	//* risposta andata con fine positivo
	request_user.done(function(response) {
		if(-1 == response.search("Errore"))	{
			$("aside#containerAside").empty().html(response);
		}	
		else {
			$(document).html(response);
		}
	});
	
	// Se Fallisce la richiesta
	request_user.fail(function(response) {
		console.log("Error Response from server! The response is :" + response);
		alert("Errore connessione al server! Le chiediamo di riprovare..");
	});
}
