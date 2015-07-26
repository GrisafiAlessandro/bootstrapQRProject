<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 26/07/2015
 * Time: 22:26
 */

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