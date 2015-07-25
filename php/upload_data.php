<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 07/07/2015
 * Time: 18:30
 */

 /** Idea :
 unire le richieste in queste API
 NOTA! upload concesso solo a pagine lato segretaria = controllo ID utente, login, sessionID ecc
  *


 NOTA! creare un mini framework php manuale
  suddividere in file pià piccoli i file
 */

 /** TIPI DI VARIABILI E RICHIESTE
 	requestType : download / upload
 	dataType : user / document / course / pdfDoc /(solo download!) qrcode, alldocuments
	download - user : userID [30 caratteri]
	download - document : documentID [30 caratteri]
	download - alldocuments : userID [30 caratteri]
	download - course : courseID [30 caratteri]
	download - pdfDoc : documentID [30 caratteri]
	download - qrcode : documentID [30 caratteri]

	upload - user : new [true/false]
		new -> false : userID [30 caratteri], name [50 caratteri], cognome [50 caratteri]
		new -> true : name [50 caratteri], cognome [50 caratteri]
	upload - document : new [true/false]
		new -> false : documentID [30 caratteri]
		new -> true :
                      ^+^ documentID [30 caratteri]
                      userID [30 caratteri]
                      title [200 caratteri]
                      place [80 caratteri]
                      releaseDate [YYYY:MM:DD]
                      img

                      isCertificato true/false
                      isAttestato true/false
                      isDiploma true/false;

                      courseID [30 caratteri]

                      certifiateResult [175 caratteri]
                      description [50000 caratteri]

	upload - course : new [true/false]
         new -> false : documentID [30 caratteri]
                        courseID [30 caratteri]
                        userID [30 caratteri]
                        coursePeriod [500 caratteri]
                        coursePlan [50000 caratteri]
                        additionalInfo [50000 caratteri]
         new -> true :
                      courseID [30 caratteri]
                      userID [30 caratteri]
                      coursePeriod [500 caratteri]
                      coursePlan [50000 caratteri]
                      additionalInfo [50000 caratteri]
	upload - pdfDoc : idDocument
 */

include "dbmysql.php";
include "class/User.php";
include "class/Document.php";
include "class/Corso.php";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**  INIZIO DEBUG */
function crea_utente() {
    $user = new User();
    $user->idUtente = generateRandomString(30);
    $user->nome = generateRandomString(6);
    $user->cognome = generateRandomString(6);
    return $user;
}

function crea_documento() {
    $utente = crea_utente();
    $corso = crea_corso();
    insert_utente($utente);

    $documento = new Document();
    $documento->idDocumento = generateRandomString(30);
    $documento->idUtente = $utente->idUtente;
    $documento->titolo = htmlspecialchars("Questo e' il titolo");
    $documento->luogoRilascio = "Pordenone";
    $documento->dataRilascio = date("Y-m-d H:i:s");
    $documento->imgLocation = "MobileQRCode/attestatoProva.jpg";
    $documento->isCertificato = false; // true; //
    $documento->isAttestato = true; // false; //
    $documento->idCorso = null; // $corso->idCorso; //
    $documento->risultatoAttestato = "I'M THE WINNER";   // null; //
    $documento->descrizione = htmlspecialchars("Questa e' la descrizione"); // null; //
    return $documento;
}

function crea_corso() {
    $utente = crea_utente();

    $corso = new Corso();
    $corso->idDocente = $utente->idUtente;
    $corso->idCorso = generateRandomString(30);
    $corso->durataCorso = "settimane..";
    $corso->programma = "...ecc ecc ecc";
    $corso->ulterioriInfo = "non ci sono";
    return $corso;
}

/** INSERIMENTO FITTIZIO MODALITA DEBUG */
 insert_Documento(crea_documento());
// insert_utente(crea_utente());
// insert_corso(crea_corso());

/** FINE DEBUG */

/** RISPOSTE AL CLIENT*/
function response_client_error($causa_errore) {
}



/** INSERIMENTO UTENTE */
function insert_utente($utente) {
    $requestToSQL = 'INSERT INTO Users (idUtente, nome, cognome) VALUES ("'
        . $utente->idUtente . '","'
        . $utente->nome . '","'
        . $utente->cognome . '")'
        ;
    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die('<script>console.log("Connection Failed : ' . $conn->connect_error . '");</script>');
    }
    else {
        echo '<script>console.log("Connected successfully");</script>';
    }

    if ($conn->query($requestToSQL) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $requestToSQL . "<br>" . $conn->error;
    }
    $conn->close();
    return ;
}

/** INSERIMENTO DOCUMENTO */
function insert_Documento($documento){
    $requestToSQL = 'INSERT INTO Documents (idDocumento,idUtente,titolo,luogoRilascio,dataRilascio,
                    imgLocation,isCertificato,isAttestato,idCorso,risultatoAttestato,descrizione) VALUES ("'
        . $documento->idDocumento . '","'
        . $documento->idUtente . '","'
        . $documento->titolo . '","'
        . $documento->luogoRilascio . '","'
        . $documento->dataRilascio . '","'
        . $documento->imgLocation . '","'
        . $documento->isCertificato . '","'
        . $documento->isAttestato . '","'
        . $documento->idCorso . '","'
        . $documento->risultatoAttestato . '","'
        . $documento->descrizione . '")'
        ;
    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die('<script>console.log("Connection Failed : ' . $conn->connect_error . '");</script>');
    }
    else {
        echo '<script>console.log("Connected successfully");</script>';
    }

    if ($conn->query($requestToSQL) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $requestToSQL . "<br>" . $conn->error;
    }
    $conn->close();
    return ;
}

/** INSERIMENTO CORSO */
function insert_Corso($corso) {
    $requestToSQL = 'INSERT INTO Courses (idCorso,idDocente,durataCorso,programmaCorso,ulterioriInfo) VALUES ("'
        . $corso->idCorso . '","'
        . $corso->idDocente . '","'
        . $corso->durataCorso . '","'
        . $corso->programma . '","'
        . $corso->ulterioriInfo . '");'
    ;
    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die('<script>console.log("Connection Failed : ' . $conn->connect_error . '");</script>');
    }
    else {
        echo '<script>console.log("Connected successfully");</script>';
    }

    if ($conn->query($requestToSQL) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $requestToSQL . "<br>" . $conn->error;
    }
    $conn->close();
    return ;
}