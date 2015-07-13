<?php
include "dbmysql.php";

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
 * Database Table Users, Documents, Courses
 *	typeRequest -> search / document / allDocuments / user
 	search -> type & pattern
	document -> ID_Document
	allDocuments -> ID_User
	user -> ID_User
 */

 /* CONTROLLO INPUT */
if($_SERVER['REQUEST_METHOD'] == "POST") {

	$tipoRichiesta = $_POST['typeRequest'];

	if(!empty($tipoRichiesta))	{
		$tipoRichiesta = safeInput($tipoRichiesta);

		/** Richiesta di ricerca */
		if($tipoRichiesta === "search")	{
			if( !empty($_POST['type']) && !empty($_POST['pattern']) && !empty($_POST['ID_User'])) {

				/** Conversione input da codice eseguibile */
				$tipoRicerca = safeInput($_POST['type']);
				$patternRicerca = safeInput($_POST['pattern']);
				$idUtente = safeInput($_POST['idUser']);

				$risposta = ricercaDB_ricercaDocumenti($tipoRicerca,$patternRicerca,$idUtente);
			}
			else {
				sayBadInput();
			}
		}
        /** Richiesta un documento specifico */
		else if($tipoRichiesta === "document") {
			$idDocumento = $_POST['ID_Documento'];

			if(!empty($idCertificato))	{

				$idDocumento = safeInput($idDocumento);

				//Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
				if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
					echo getDocumento($idDocumento);
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
					echo getElencoDocumenti($idUtente);
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
					echo getDocente($idUtente);
				}
			}
		}
		else {
			echo sayBadInput();
		}
	}
}

/** Funzione di test richiesta da codice maligno per prevenire
 * codice javascript eseguibile
 */
function safeInput($data) {
    //$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/** ESECUZIONE RICHIESTE, FORMAZIONE RISPOSTE, INVIO DATI */
function getDocumento($idDocumento) {
    // ricerco documento
	$documento = ricercaDB_Documento($idDocumento);

    if(null != $documento ) {
        $utente = ricercaDB_utente($documento->idUtente);
        $rispostaPronta = risposta_infoDocumento($utente,$documento); //Costruisco la risposta in HTML
    }
    else {
        $rispostaPronta = sayNotFound();
    }
	return $rispostaPronta; // Invio la risposta
}

function getImage($idDocumento) {
    $documento = ricercaDB_Documento($idDocumento); // Ricerco documento

    if(null != $documento ) {
        $rispostaPronta = risposta_immagine($documento); //Costruisco la risposta in HTML
    }
    else {
        $rispostaPronta = sayNotFound();
    }
    return $rispostaPronta;
}

function getElencoDocumenti($idUtente) {
	$vettDocumenti = ricercaDB_elencoDocumenti($idUtente); // Ricerco i documenti nel DB
	$rispostaPronta = risposta_elencoDocumenti($vettDocumenti); // Costruisco la risposta in HTML
    return $rispostaPronta; // Invio la risposta
}

function getDocente($idUtente) {
	$utente = ricercaDB_Utente($idUtente); // Ricerco info cliente
	$vettDocumenti = ricercaDB_elencoDocumenti($idUtente); // Ricerco i documenti nel DB
	$rispostaPronta = risposta_Docente($utente,$vettDocumenti); // Costruisco la risposta
    return $rispostaPronta; // Invio la risposta
}

function sayNotFound() {
    $rispostaPronta = risposta_notFound();
    return $rispostaPronta; // Invio la risposta
}

function sayBadInput() {
	$rispostaPronta = risposta_badInput();
    return $rispostaPronta; // Invio la risposta
}

/** Funzioni di ricerca nel database */
function ricercaDB_ricercaDocumenti($tipoRicerca = "titolo",$patternRicerca = "",$idUtente) {
	include_once "class/Document.php";
	$rispostaDB = new Document();
	$requestToSQL = "SELECT titolo";//data, isAttestato
	$addField = "";

	if("titolo" != $tipoRicerca) {
		if("data" == $tipoRicerca) {
			$requestToSQL .= ",data";
		}
		else if("tipo" == $tipoRicerca) {
			$pattern = "/^" . strtolower($patternRicerca) . "*$/";

			if(preg_match($pattern,"attestato corso")) {
				$addField = " AND isAttestato='true'";

			}
			else if(preg_match($pattern,"certificato corso")){
				$addField = " AND isCertificato='true'";
			}
		}
	}
	$requestToSQL .= " FROM Documents WHERE idUtente='" . $idUtente . "'" . $addField;

	// Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rispostaDB->idDocumento = $row['idDocumento'];
                $rispostaDB->titolo = $row['titolo'];
                $rispostaDB->isCertificato = $row['isCertificato'];
                $rispostaDB->isAttestato = $row['isAttestato'];
            }
        }
    }
    $conn->close();
	return $rispostaDB;
}

function ricercaDB_documento($idDocumento) {
    include_once "class/Document.php";
    $rispostaCostruita = new Document();

	$requestToSQL = "SELECT * FROM Documents WHERE idDocumento='" . $idDocumento . "'";

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rispostaCostruita->idDocumento = $row['idDocumento'];
                $rispostaCostruita->idUtente = $row['idUtente'];
                $rispostaCostruita->titolo = $row['titolo'];
                $rispostaCostruita->luogoRilascio = $row['luogoRilascio'];
                $rispostaCostruita->dataRilascio = $row['dataRilascio'];
                $rispostaCostruita->imgLocation = $row['imgLocation'];
                $rispostaCostruita->isCertificato = $row['isCertificato'];
                $rispostaCostruita->isAttestato = $row['isAttestato'];
                $rispostaCostruita->idCorso = $row['idCorso'];
                $rispostaCostruita->risultatoAttestato = $row['risultatoAttestato'];
                $rispostaCostruita->descrizione = $row['descrizione'];
            }
        }
    }
    $conn->close();
	return $rispostaCostruita;
}

/** Funzioni di ricerca nel database */
function ricercaDB_elencoDocumenti($idUtente) {
    include_once "class/Document.php";
    $rispostaCostruita = new Document();

    $requestToSQL = "SELECT * FROM Documents WHERE idUtente='" . $idUtente . "'";

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rispostaCostruita->idDocumento = $row['idDocumento'];
                $rispostaCostruita->idUtente = $row['idUtente'];
                $rispostaCostruita->titolo = $row['titolo'];
                $rispostaCostruita->luogoRilascio = $row['luogoRilascio'];
                $rispostaCostruita->dataRilascio = $row['dataRilascio'];
                $rispostaCostruita->imgLocation = $row['imgLocation'];
                $rispostaCostruita->isCertificato = $row['isCertificato'];
                $rispostaCostruita->isAttestato = $row['isAttestato'];
                $rispostaCostruita->idCorso = $row['idCorso'];
                $rispostaCostruita->risultatoAttestato = $row['risultatoAttestato'];
                $rispostaCostruita->descrizione = $row['descrizione'];
            }
        }
    }
    $conn->close();
    return $rispostaCostruita;
}

// Ricerca l'utente
function ricercaDB_utente($idUtente) {
	include_once "class/User.php";

    $rispostaCostruita = new User();
	$requestToSQL = "SELECT * FROM Users WHERE idUtente='" . $idUtente . "'";

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rispostaCostruita->idUtente = $row['idUtente'];
                $rispostaCostruita->nome = $row['nome'];
                $rispostaCostruita->cognome = $row['cognome'];
            }
        }
    }
    $conn->close();
    return $rispostaCostruita;
}

function ricercaDB_corso($idCorso)
{
    include_once "class/Corso.php";

    $rispostaCostruita = new Corso();
    $requestToSQL = "SELECT * FROM Courses WHERE idCorso='" . $idCorso . "'";

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : " . $conn->connect_error . "');</script>");
    } else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rispostaCostruita->idCorso = $row['idCorso'];
                $rispostaCostruita->idDocente = $row['idDocente'];
                $rispostaCostruita->durataCorso = $row['durataCorso'];
                $rispostaCostruita->programma = $row['programma'];
                $rispostaCostruita->ulterioriInfo = $row['infoUlteriori'];
            }
        }
    }
    $conn->close();
    return $rispostaCostruita;
}

/** COSTRUTTORI DI RISPOSTA */
function risposta_corso($corso) {
	$docente = ricercaDB_Utente($corso->idDocente);

	$risposta = '<li><ul id="teacher" class="identita"><li class="nome">'
		. $docente->nome . '</li><li class="nome">'
		. $docente->cognome . '</li></ul><li><article>'
		. $corso->durataCorso . '</article></li><li><article>'
		. $corso->programma . '</article></li><li><article>'
		. $corso->infoUlteriori . '</article></li>'
		;
	return $risposta;
}

/** DOCUMENTO */
function risposta_infoDocumento($utente,$documento) {
	$risposta =  '<div><ul style="list-style-type:none;" data-idDocument=""><li><article><h1>'
		. $documento->titolo . '</h1></article></li><li><ul class="identita" data-idUser="'
        . $documento->user . '" ><li class="nome""><article>'
		. $utente->nome . '</article></li><li class="nome" ><article>'
		. $utente->cognome . '</article></li></ul></li><li><article>'
		. $documento->luogoRilascio . '</article></li><li><article>'
		. $documento->dataRilascio . '</article></li>'
		;

		if($documento->isCertificato) {
			$oggettoCorso = richiestaDB_Corso($documento->idCorso);
			$risposta .= risposta_corso($oggettoCorso);
		}
		else if($documento->isAttestato) {
			$risposta .= "<li><article>" . $documento->risultatoAttestato . "</article></li>";

			if( null != $documento->descrizione ) {
				$risposta .= "<li><article>" . $documento->descrizione . "</article></li>"	;
			}
		}
		$risposta .= "</ul></div>";
	return $risposta;
}
 /** ELENCO DOCUMENTI */
function risposta_elencoDocumenti($vettDocumenti) {
	$risposta = '<div id="documenti"><ul data-idDocument="'
		. $vettDocumenti[0]->idUtente .'">'
		;

	foreach($vettDocumenti as $documento) {
		$risposta .= '<li name="'
			. $documento->idDocumento . '">'
			. $documento->titolo . '</li>'
			;
	}
	$risposta .= "</ul></div>";
	return $risposta;
}

/** DOCENTE*/
function risposta_docente($utente,$vettDocumenti) {
	$risposta = '<div><ul class="identita"><li class="nome">'
		. $utente->nome .'</li><li class="nome">'
		. $utente->cognome . '</li></ul></div>'
		. risposta_elencoDocumenti($vettDocumenti);
	return $risposta;
}

/** IMMAGINE/PDF DOCUMENTO */
function risposta_immagine($documento) {
    $risposta = '<img alt="'
        . $documento->titolo . '" id="imgDoc" src="'
        . $documento->imgLocation . '">';
    return $risposta;
}

/** ELEMENTO NON TROVATO NEL DATABASE */
function risposta_notFound() {
    $risposta = '<script>alert("Errore! Non è stato trovato niente nel database");</script>';
    return $risposta;
}

/** RICHIESTA IN INPUT ERRATA */
function risposta_badInput() {
    $risposta = '<script>alert("Errore! Richiesta al server è formulata male");</script>';
    return $risposta;
}