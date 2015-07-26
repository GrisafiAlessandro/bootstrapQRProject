<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:17
 */

if(!empty($_POST['documentID'])) {
    /* Protezione input da codice eseguibile */
    $idDocumento = safeInput($_POST['documentID']);

    /* Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri */
    if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
        main_document($idDocumento);
    }
}
else {
    sayBadInput("Errore! Il parametro documentID è vuoto!");
}

/** RICHIESTA IN SQL PER CERCARE IL DOCUMENTO */
function build_sql_request_document($idDocumento) {
    $requestToSQL = "SELECT titolo,imgLocation FROM Documents WHERE idDocumento='" . $idDocumento . "'";
    return $requestToSQL;
}


/** IMMAGINE/PDF DOCUMENTO */
function build_HTML($documento) {
    $risposta = '<img alt="'
        . $documento->titolo . '" id="imgDoc" src="'
        . $documento->imgLocation . '">';
    return $risposta;
}