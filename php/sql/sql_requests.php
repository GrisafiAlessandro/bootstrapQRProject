<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:38
 */

/** Funzioni di ricerca nel database */
function ricercaDB_ricercaDocumenti($requestToSQL) {
    $rispostaDB = new Document();

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