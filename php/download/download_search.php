<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:01
 */

if( !empty($_POST['type']) && !empty($_POST['pattern']) && !empty($_POST['userID'])) {

    /** Conversione input da codice eseguibile */
    $tipoRicerca = safeInput($_POST['type']);
    $patternRicerca = safeInput($_POST['pattern']);
    $idUtente = safeInput($_POST['userID']);

    //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
    if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
            if(6 > strlen($tipoRicerca)&& 100 > $patternRicerca) {
                main($tipoRicerca,$patternRicerca,$idUtente);
            }else {
                sayBadInput("Errore! Parametri ricerca non soddisfano la lunghezza!");
            }
    }else {
        sayBadInput("Errore! userID non valido!");
    }
}else {
    sayBadInput("Errore! Parametri vuoti o non completi!");
}

/** MAIN - TUTTE LE AZIONI SI SVOLGONO QUI */
function main($tipoRicerca,$patternRicerca,$idUtente) {
    include_once (root_dir_php. 'class/Document.php');

    $sqlRequest = build_sql_request($tipoRicerca,$patternRicerca,$idUtente);
    $rispostaDB = ricercaDB($sqlRequest);

    if (null != $rispostaDB)
        $rispostaHTML = build_build_HTML_search_resultsHTML($rispostaDB);
    else {
        $rispostaHTML = sayNotFound("Ricerca non prodotto risultati");
    }
    echo  $rispostaHTML;
}

function build_sql_request($tipoRicerca = "titolo",$patternRicerca,$idUtente) {
    $requestToSQL = 'SELECT titolo';//data, isAttestato
    $addField = '';

    if('titolo' != $tipoRicerca) {
        if('data' === $tipoRicerca) {
            $requestToSQL .= ',data';
        }
        else if("tipo" === $tipoRicerca) {
            $pattern = "/^" . strtolower($patternRicerca) . "*$/";

            if(preg_match($pattern,"/attestato corso/")) {
                $addField = " AND isAttestato='true'";
            }
            else if(preg_match($pattern,"certificato corso")){
                $addField = " AND isCertificato='true'";
            }
        }
    }
    $requestToSQL .= " FROM Documents WHERE idUtente='" . $idUtente . "'" . $addField;
    return $requestToSQL;
}

/** PRENDO I RISULTATI DEL DATABASE */
function parse_sql_document($sql_response){
    $documentsArray[] = array();
    if(isset($sql_response)) {
        $document = new Document();
        $counter = 0;
        while($row = $sql_response->fetch_assoc()) {
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
            $documentsArray[$counter] = $document;
            ++$counter;
        }
    }
    return $document;
}

function build_HTML_search_results($vettDocumenti) {
    $risposta = '';
    foreach($vettDocumenti as $documento) {
        $risposta .= '<li name="'
            . $documento->idDocumento . '">'
            . $documento->titolo . '</li>'
        ;
    }
    return $risposta;
}