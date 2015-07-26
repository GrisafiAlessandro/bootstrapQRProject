<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 26/07/2015
 * Time: 22:27
 */

/** INSERIMENTO CORSO */
function insert_corso($corso) {
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