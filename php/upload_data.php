<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 07/07/2015
 * Time: 18:30
 */

include "dbmysql.php";
include "User.php";
include "Document.php";

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
function create_utente() {
    $user = new User();
    $user->idUtente = generateRandomString(30);
    $user->nome = generateRandomString(6);
    $user->cognome = generateRandomString(6);
    return $user;
}

function crea_documento() {
    $documento = new Document();
    $documento->idDocumento = generateRandomString(30);
    $documento->idUtente = generateRandomString(20);
    $documento->titolo = htmlspecialchars("Questo è il titolo");
    $documento->luogoRilascio = "Pordenone";
    $documento->dataRilascio = "Oggi/domani7sempre";
    $documento->imgLocation = "lbtest.altervista.org/immagine.png";
    $documento->isCertificato = false;
    $documento->isAttestato = true;
    $documento->idCorso = null;
    $documento->risultatoAttestato = "I'M THE WINNER";
    $documento->descrizione = htmlspecialchars("Questa è decrizione");
    return $documento;
}

/** INSERIMENTO FITTIZIO MODALITA DEBUG */
insert_Documento(crea_documento());
// insert_utente(create_utente());

/** FINE DEBUG */
//Inserisci utente
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