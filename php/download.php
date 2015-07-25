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
    $tipoRichiesta = $_POST['dataType'];

    if(!empty($tipoRichiesta))	{
        $tipoRichiesta = safeInput($tipoRichiesta);

        /** Richiesta di ricerca */
        if($tipoRichiesta === "search")	{
            include 'download/download_search.php';
        }
        /** Richiesta un documento specifico */
        else if($tipoRichiesta === "document") {
            include 'download/download_document.php';
        }
        /**  Richiesta di tutti i documenti di un utente */
        else if($tipoRichiesta === "allDocuments") {

            $idUtente = $_POST['userID'];

            if(!empty($idUtente)) {
                $idUtente = safeInput($idUtente);

                //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
                if( 10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
                    echo getElencoDocumenti($idUtente);
                }
            }
        }
        /** Richiesta info docente */
        else if($tipoRichiesta === "user") {
            include 'download/download_user.php';
        }
        else {
            echo sayBadInput("Errore! typeRequest errato!");
        }
    }
}