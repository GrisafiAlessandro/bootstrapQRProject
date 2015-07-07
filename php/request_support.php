<?php

$GLOBALS['$servername'] = "localhost";
$GLOBALS['$username'] = "lbTest";
$GLOBALS['$password'] = "alphabetagamma";
$GLOBALS['dbname'] = "DB_Sistema";

/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 03/07/2015
 * Time: 19:34
 *
 * parametri richiesta :
 * - richiesta certificato
 * - richiesta lista certificati
 * - richiesta dati utente (fare controllo che sia un docente o no?? )
 *
 *  requestType = document/allDocuments/user
 *
 * Database Table Users :
 * idUtente text 30
 * nome text 40
 * cognome text 40
 *
 * Database Table Documenti
 * idDocumento
 * titolo text 255
 * luogoRilascio text 100
 * dataRilascio data
 * descrizione text 40000
 *
 *
 */

 /* CONTROLLO INPUT */
if($_SERVER['REQUEST_METHOD'] == "POST") {
	
	$tipoRichiesta = $_POST['typeRequest'];
	
	if(!empty($tipoRichiesta))	{
		$tipoRichiesta = safeInput($tipoRichiesta);
		
		/** Richiesta di ricerca */
		if($tipoRichiesta === "search")	{
			if(!empty($_POST['type']) && !empty($_POST['pattern'])){
				
			}
		}
        /** Richiesta un documento specifico */
		else if($tipoRichiesta === "document") {
			$idDocumento = $_POST['ID_Documento'];

			if(!empty($idCertificato))	{

				$idDocumento = safeInput($idDocumento);

				//Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
				if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
					getDocumento($idDocumento);
				}
			}
		}
        /**  Richiesta di tutti i documenti di un utente */
		else if($tipoRichiesta === "allDocuments") {

			$idUtente = $_POST['ID_User'];

			if(!empty($idUtente)) {
				$idUtente = safeInput($idUtente);

				//Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
				if( 10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
					getElencoDocumenti($idUtente);
				}
			}
		}
        /** Richiesta info docente */
		else if($tipoRichiesta === "user") {
			$idUtente = $GLOBALS['ID_User'];

			if(!empty($idUtente)) {
				$idUtente = safeInput($idUtente);
				
				//Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
				if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
					getDocente($idUtente);
				}
			}
		}
		else {
			sayBadRequest();
		}
	}
}

/** Funzione di test richiesta da codice maligno per prevenire
 * codice javascript eseguibile
 */
function safeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* ESECUZIONE RICHIESTE, FORMAZIONE RISPOSTE, INVIO DATI */
function getDocumento($idDocumento) {
	$documento = ricercaDB_Documento($idDocumento);
	//Costruisco la risposta in HTML
	$rispostaPronta = risposta_infoDocumento($documento);
	// Invio la risposta
	echo $rispostaPronta;
}

function getElencoDocumenti($idUtente) {
	// Ricerco utente
	$utente = ricercaDB_Utente($idUtente);
	$vettDocumenti = ricercaDB_elencoDocumenti($idUtente);
	//Costruisco la risposta in HTML
	$rispostaPronta = risposta_elencoDocumenti($vettDocumenti);
	// Invio la risposta
	echo $rispostaPronta;
}

function getDocente($idUtente) {
	// Ricerco info cliente
	$utente = ricercaDB_Utente($idUtente);
	$vettDocumenti = ricercaDB_elencoDocumenti($idUtente);
	// Costruisco la risposta
	$rispostaPronta = risposta_Docente($utente,$vettDocumenti);
	// Invio la risposta
	echo $rispostaPronta;	
}

function sayBadRequest() {
	$rispostaPronta = risposta_badInput();
    echo $rispostaPronta;
}

/** Funzioni di ricerca nel database */
function ricercaDB_documento($idDocumento) {
    include_once "Document.php";
    $rispostaCostruita = new Document();

	$requestToSQL = "SELECT * FROM Documents WHERE idDocumento=" . $idDocumento;

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    echo "<script>console.log('Connected successfully');</script>";

    $conn->close();
	return $rispostaCostruita;
}

// Ricerca l'utente
function ricercaDB_utente($idUtente) {
	include_once "User.php";
	
    $rispostaCostruita = new User();
	$requestToSQL = "SELECT * FROM Users WHERE idUtente=" . $idUtente;

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    echo "<script>console.log('Connected successfully');</script>";

    $conn->close();
	return $rispostaCostruita;
}

function ricercaDB_corso($idCorso) {
	include_once "Corso.php";
	
	$rispostaCostruita = new Corso();
	$requestToSQL = "SELECT * FROM Courses WHERE idCorso=" . $idCertificato;

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    echo "<script>console.log('Connected successfully');</script>";

    $conn->close();
	return $rispostaCostruita;
}

/** COSTRUTTORI DI RISPOSTA */
function risposta_corso($corso) {
	$docente = ricercaDB_Utente($corso->idDocente);
	
	$risposta = '<li><ul class="identita"><li class="nome">' 
		. $docente->nome . '</li><li class="nome">'
		. $docente->cognome . '</li></ul><li>'
		. $corso->durataCorso . '</li><li>'
		. $corso->programma . '</li><li>' 
		. $corso->infoUlteriori . '</li>'
		;
	return $risposta;
}

function risposta_infoDocumento($documento) {
	$risposta =  "<div><ul style='list-style-type:none'><li>" 
		. $documento->titolo . '</li><li><ul class="identita" style="display:inline;"><li class="nome">' 
		. $documento->nome . '</li><li class="nome">' 
		. $documento->cognome . '</li></ul></li><li>' 
		. $documento->luogoRilascio . '</li><li>'
		. $documento->dataRilascio->dataStamp() . '</li>'
		;
		
		if($documento->isCertificato) {
			$oggettoCorso = richiestaDB_Corso($documento->idCorso);
			$risposta += risposta_corso($oggettoCorso);			
		}
		else if($documento->isAttestato) {
			$risposta += "<li>" . $documento->risultatoAttestato . "</li>";
			
			if( null != $documento->descrizione ) {
				$risposta += "<li>" . $documento->descrizione . "</li>"	;
			}
		}
		$risposta += "</ul></div>";	
	return $risposta;
}

function risposta_elencoDocumenti($vettDocumenti) {
	$risposta = '<div id="documenti"><ul name="'
		. $documento->idUtente .'">'
		;
	
	foreach($vettDocumenti as $documento)
	{
		$risposta += '<li name="' 
			. $documento->idDocumento . '">' 
			. $documento->titolo . '</li>'
			;
	}	
	$risposta += "</ul></div>";	
	
	return $risposta;
}

function risposta_Docente($utente,$vettDocumenti) {
	$risposta = '<div><ul class="identita"><li class="nome">'
		. $utente->nome .'</li><li class="nome">'
		. $utente->cognome . '</li></ul></div>'
		. risposta_elencoDocumenti($vettDocumenti);
		
	return $risposta;
}