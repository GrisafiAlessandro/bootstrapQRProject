$(function(){
	$("btn#infoD").click();
	$("btn#infoAllD").click();
	$("btn#Search").click();
	$("btn#copyright").click(draw_copyright());
	$("ul.docList > li").click(selectDocument(this));
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

function draw_copyright() {
	// float right
	var divCopyright = '<div id="divCopyright"><ul id="infoKennedy">'
		+ '<li><h2>ITST Kennedy</h2></li>'
		+ '<li><h3>Via Interna, 7</h3></li>'
		+ '<li><h3>33070 Pordenone</h3></li>'
		+ '<li><h3>Tel: 0434 36 53 31</h3></li>'
		+ '<li><h3>Fax: 0434 365400</h3></li>'
		+ '<li><h3>C.F.: 80007410931</h3></li>'
		+ '<li><h3>Email: pntf01000a@istruzione.it</h3></li>'
		+ '<li><h3>PEC: pntf01000a@pec.istruzione.it</h3></li>';
	
	if(window.innerWidth > 800) {
		divCopyright += '<li><iframe></iframe></li>';
	}
	
	divCopyright += '</ul></div>';

	$(document).add(divCopyright);

}
