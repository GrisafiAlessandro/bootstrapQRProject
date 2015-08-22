<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:03
 */

if(isset($_POST['userID'])) {
    $idUtente = safeInput($_POST['userID']);

    //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
    if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
        main($idUtente);
    }
}

function main($idUtente) {

}

/* RICHIESTA IN SQL PER CERCARE L'UTENTE */
function build_sql_request_user($userID) {
    $requestToSQL = "SELECT nome,cognome FROM Users WHERE idUtente='" . $userID . "'";
    return $requestToSQL;
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

function build_HTML () {

}