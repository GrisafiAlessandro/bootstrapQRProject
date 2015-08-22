<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:04
 */

if(isset($_POST['documentID'])) {
    /* Protezione input da codice eseguibile */
    $idDocumento = safeInput($_POST['documentID']);

    /* Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri */
    if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
        main_document($idDocumento);
    }
}
else if(isset($_GET['documentID'])) {
    /* Protezione input da codice eseguibile */
    $idDocumento = safeInput($_GET['documentID']);

    /* Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri */
    if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
        main_document($idDocumento);
    }
}
else {
    sayBadInput("Errore! Il parametro documentID è vuoto!");
}

/* MAIN - TUTTE LE AZIONI SI SVOLGONO QUI */
function main_document($idDocumento)
{
    include_once(root_dir_php . 'class/Document.php');
    $sqlRequest = build_sql_request_document($idDocumento);

    $rispostaDB_documento = ricercaDB($sqlRequest);

    if (isset($rispostaDB_documento)) {
        include_once(root_dir_php . 'class/User.php');

        $documento = parse_sql_document($rispostaDB_documento);
        $sqlRequest = build_sql_request_user($documento->idUtente);

        $rispotaDB_utente = ricercaDB($sqlRequest);
        $utente = parse_sql_user($rispotaDB_utente);

        $rispostaHTML = build_HTML($utente, $rispostaDB_documento); //Costruisco la risposta in HTML
    } else {
        $rispostaHTML = sayNotFound("Documento non trovato nel DataBase");
    }
    echo $rispostaHTML;
}

/* RICHIESTA IN SQL PER CERCARE IL DOCUMENTO */
function build_sql_request_document($idDocumento) {
    $requestToSQL = "SELECT idDocumento,titolo,idUtente,idCorso,luogoRilascio,dataRilascio,
                      isCertificato,isAttestato,risultatoAttestato, descrizione
                      FROM Documents WHERE idDocumento='" . $idDocumento . "'";
    return $requestToSQL;
}

/* RICHIESTA IN SQL PER CERCARE L'UTENTE */
function build_sql_request_user($userID) {
    $requestToSQL = "SELECT nome,cognome FROM Users WHERE idUtente='" . $userID . "'";
    return $requestToSQL;
}

/* RICHIESTA IN SQL PER CERCARE L'UTENTE */
function build_sql_request_course($courseID) {
    $requestToSQL = "SELECT idDocente,durataCorso,programmaCorso,ulterioriInfo FROM Courses WHERE idCorso='" . $courseID . "'";
    return $requestToSQL;
}

/* CONVERTO I RISULTATI DEL DATABASE */
function parse_sql_document($sql_response){
    $document = null;
    if(isset($sql_response)) {
        $document = new Document();
        while($row = mysql_fetch_assoc($sql_response)) {
            $document->idDocumento = $row['idDocumento'];
            $document->idUtente = $row['idUtente'];
            $document->titolo = $row['titolo'];
            $document->luogoRilascio = $row['luogoRilascio'];
            $document->dataRilascio = $row['dataRilascio'];
            $document->imgLocation = $row['imgLocation'];
            $document->isCertificato = $row['isCertificato'];
            $document->isAttestato = $row['isAttestato'];
            $document->idCorso = $row['idCorso'];
            $document->risultatoAttestato = $row['risultatoAttestato'];
            $document->descrizione = $row['descrizione'];
        }
    }
    return $document;
}

function parse_sql_user($sql_response){
    $user = null;
    if(isset($sql_response)) {
        $user = new User();
        while($row = mysql_fetch_assoc($sql_response)) {
            $user->nome = $row['nome'];
            $user->cognome = $row['cognome'];
        }
    }
    return $user;
}

function parse_sql_course($sql_response){
    $user = null;
    if(isset($sql_response)) {
        $user = new Corso();
        while ($row = mysql_fetch_assoc($sql_response)) {
            $user->idCorso = $row['idCorso'];
            $user->idDocente = $row['idDocente'];
            $user->durataCorso = $row['durataCorso'];
            $user->programma = $row['programma'];
            $user->ulterioriInfo = $row['infoUlteriori'];
        }
    }
    return $user;
}

/* RISPOSTA HTML DOCUMENTO */
function build_HTML_document($utente,$documento) {

    $risposta =  '<div><ul style="list-style-type:none;" data-idDocument=""><li><article><h1>'
        . $documento->titolo . '</h1></article></li><li><ul class="identita" data-idUser="'
        . $documento->user . '" ><li class="name""><article>'
        . $utente->nome . '</article></li><li class="name" ><article>'
        . $utente->cognome . '</article></li></ul></li><li><article>'
        . $documento->luogoRilascio . '</article></li><li><article>'
        . $documento->dataRilascio . '</article></li>'
    ;

    if($documento->isCertificato) {
        include_once (root_dir_php . 'class/Corso.php');
        $corso = parse_sql_course(ricercaDB(build_sql_request_course($documento->idCorso)));
        $docente = parse_sql_user(ricercaDB(build_sql_request_user($corso->idDocente)));

        if( isset($corso) && isset($docente)) {
            $risposta = build_HTML_course($docente, $corso);
        }
    }
    else if($documento->isAttestato) {
        $risposta .= "<li><article>" . $documento->risultatoAttestato . "</article></li>";

        if( null != $documento->descrizione ) {
            $risposta .= "<li><article>" . $documento->descrizione . "</article></li>"	;
        }
    }
    else if($documento->isDisploma) {

    }

    $risposta .= "</ul></div>";
    return $risposta;
}

/* COSTRUTTORI DI RISPOSTA CORSI */
function build_HTML_course($docente,$corso) {

    $risposta = '<li><ul id="teacher" class="identita"><li class="name">'
        . $docente->nome . '</li><li class="name">'
        . $docente->cognome . '</li></ul><li><article>'
        . $corso->durataCorso . '</article></li><li><article>'
        . $corso->programma . '</article></li><li><article>'
        . $corso->infoUlteriori . '</article></li>'
    ;
    return $risposta;
}