$(function(){
	$("btn#infoD").click();
	$("btn#infoAllD").click();
	$("btn#Search").click();
	$("btn#copyright").click(draw_copyright());
	$("ul.docList > li").click(select(this));
	$("ul#teacher").click(selectTeacher(this));

	$();


});

// Select the document whose informations User want to see
function selectDocument(element) {
	
	var idDocument = element.attr("data-idDocument");
	getDocumentFromServer(idDocument);
}

// Select teacher whose certifications user want to see
function selectTeacher(element) {
	var idDocente = elemnt.attr("data-idDocente");
	getdocenteFromServer
}

