<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 26/07/2015
 * Time: 22:27
 */

/** INSERIMENTO DOCUMENTO */
function insert_documento($documento){
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