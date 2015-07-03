<?php
include "Certificate_class";
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 03/07/2015
 * Time: 19:34
 *
 * parametri richiesta :
 * - richiesta certificato
 * - richiesta lista certificati
 * - richiesta dati utente (fare controllo che sia un docente o no?? )
 *
 *  requestType = document/allDocument/user
 *
 *
 *
 * Database Table Users :
 * nome text 40
 * cognome text 40
 * titolo text 255
 * luogoRilascio text 100
 * dataRilascio data
 * descrizione text 40000
 *
 *
 */
if($_SERVER['REQUEST_METHOD'] == "POST") {




    $idCertificato = $_POST['ID_Certificato'];

    if(!empty($idCertificato) && null != $idCertificato) {
        $idCertificato = test_input($idCertificato);

        //Controllo se la stringa è lunga 30 caratteri
        include "php/Certificate_class.php";
        $_GLOBALS['certificato'] = new Document();
    }

}


// Funzioni
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;



}

