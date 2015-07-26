<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 16:38
 */
include 'common.php';

/** CONTROLLO INPUT */
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $tipoDati = $_POST['dataType'];

    if(!empty($tipoDati))	{
        $tipoDati = safeInput($tipoDati);

        if(preg_match('/^[a-zA-Z]*$/',$tipoDati)) {
            /* Richiesta di ricerca */
            if($tipoDati === "search")	{
                include 'download/download_search.php';
            }
            /* Richiesta un documento specifico */
            else if($tipoDati === "document") {
                include 'download/download_document.php';
            }
            /*  Richiesta di tutti i documenti di un utente */
            else if($tipoDati === "allDocuments") {
                include 'download/download_allDocuments.php';
            }
            /* Richiesta info docente */
            else if($tipoDati === "user") {
                include 'download/download_user.php';
            }
            else {
                echo sayBadInput("Errore! datatype non ammesso!");
            }
        }
        else {
            sayBadInput("Input errato! Variabile datatype contiene caratteri non validi");
        }
    }
}