<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:38
 */

/** Funzioni di ricerca nel database */

function ricercaDB($requestToSQL) {
    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);
    // Check connection
    if ($conn->connect_error) {
        die("<script>console.log('Connection Failed : ". $conn->connect_error . "');</script>");
    }
    else {
        echo "<script>console.log('Connected successfully');</script>";
        $result = $conn->query($requestToSQL);
    }
    $conn->close();
    return $result;
}