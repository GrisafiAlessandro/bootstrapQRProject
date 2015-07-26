<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 26/07/2015
 * Time: 22:42
 */

if(!empty($_POST['userID'])) {
    $idUtente = safeInput($_POST['userID']);

    //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
    if( 10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
        main_allDocuments($idUtente);
    }
}
else {
    sayBadInput("Errore! Il parametro userID è vuoto!");
}

/** MAIN - TUTTE LE AZIONI SI SVOLGONO QUI */
function main_allDocuments($idUtente) {
    include_once(root_dir_php . 'class/Document.php');

    $sqlRequest = build_sql_request_allDocuments($idUtente);
    $rispostaDB = ricercaDB($sqlRequest);

    if (isset($rispostaDB)) {
        $vettDocumenti = parse_sql_allDocuments($rispostaDB);
        $rispostaHTML = build_HTML($vettDocumenti); //Costruisco la risposta in HTML
    } else {
        $rispostaHTML = sayNotFound("Ricerca non ha prodotto risultati");
    }
    echo $rispostaHTML;
}

/** RICHIESTA IN SQL PER CERCARE IL DOCUMENTO */
function build_sql_request_allDocuments($idUtente) {
    $requestToSQL = "SELECT idDocumento,titolo FROM Documents WHERE idUtente='" . $idUtente . "'";
    return $requestToSQL;
}

/** CONVERTO I RISULTATI DEL DATABASE */
function parse_sql_allDocuments($sql_response) {
    $documentsArray[] = array();
    if(isset($sql_response)) {
        $document = new Document();
        $counter = 0;
        while($row = mysqli_fetch_assoc($sql_response)) {
            $document->idDocumento = $row['idDocumento'];
            $document->titolo = $row['titolo'];

            $documentsArray[$counter] = $document;
            ++$counter;
        }
    }
    return $documentsArray;
}

/** COSTRUTTORI DI RISPOSTA */
function build_HTML_allDocuments($vettDocumenti) {
    $risposta = '';
    foreach($vettDocumenti as $documento) {
        $risposta .= '<li data-idDocument="'
            . $documento->idDocumento . '">'
            . $documento->titolo . '</li>'
        ;
    }
    return $risposta;
}