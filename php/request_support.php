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
			echo saybadInput();
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

/** ESECUZIONE RICHIESTE, FORMAZIONE RISPOSTE, INVIO DATI */
function getDocumento($idDocumento) {
    // ricerco documento
	$documento = ricercaDB_Documento($idDocumento);

    if(null != $documento ) {
        $rispostaPronta = risposta_infoDocumento($documento); //Costruisco la risposta in HTML
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
    return $rispostaPronta = "ciao"; // Invio la risposta
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

function saybadInput() {
	$rispostaPronta = risposta_badInput();
    return $rispostaPronta; // Invio la risposta
}

/** Funzioni di ricerca nel database */
function ricercaDB_documento($idDocumento) {
    include_once "Document.php";
    $rispostaCostruita = new Document();

	$requestToSQL = "SELECT TOP 1 FROM Documents WHERE idDocumento=" . $idDocumento;

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
    include_once "Document.php";
    $rispostaCostruita = new Document();

    $requestToSQL = "SELECT * FROM Documents WHERE idUtente=" . $idUtente;

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
	include_once "User.php";

    $rispostaCostruita = new User();
	$requestToSQL = "SELECT * FROM Users WHERE idUtente=" . $idUtente;

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
    include_once "Corso.php";

    $rispostaCostruita = new Corso();
    $requestToSQL = "SELECT * FROM Courses WHERE idCorso=" . $idCorso;

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
                $rispostaCostruita->infoUlteriori = $row['infoUlteriori'];
            }
        }
    }
    $conn->close();
    return $rispostaCostruita;
}

/** COSTRUTTORI DI RISPOSTA */
function risposta_corso($corso) {
	$docente = ricercaDB_Utente($corso->idDocente);

	$risposta = '<li><ul id="utente_identitaDocente" class="identita"><li class="nome">'
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
			$risposta .= risposta_corso($oggettoCorso);
		}
		else if($documento->isAttestato) {
			$risposta .= "<li>" . $documento->risultatoAttestato . "</li>";

			if( null != $documento->descrizione ) {
				$risposta .= "<li>" . $documento->descrizione . "</li>"	;
			}
		}
		$risposta .= "</ul></div>";
	return $risposta;
}

function risposta_elencoDocumenti($vettDocumenti) {
	$risposta = '<div id="documenti"><ul name="'
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
function risposta_Docente($utente,$vettDocumenti) {
	$risposta = '<div><ul class="identita"><li class="nome">'
		. $utente->nome .'</li><li class="nome">'
		. $utente->cognome . '</li></ul></div>'
		. risposta_elencoDocumenti($vettDocumenti);

	return $risposta;
}

function risposta_immagine($documento) {
    $risposta = '<img alt="'
        . $documento->titolo . '" id="imgDocumento" src="'
        . $documento->imgLocation . '">';
    return $risposta;
}