<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 16:51
 */

/** Definizione di directory path per inclusione di file con indirizzi relativi */
define('root_dir_path',dirname(__DIR__).'/');
define('root_dir_php',dirname(__DIR__).'/php/');

/** Funzione e richiesta da codice maligno per prevenire
 * codice javascript eseguibile
 */
function safeInput($data) {
    //$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/** RICHIESTA IN INPUT ERRATA */
function sayBadInput($messaggioErrore) {
    // Controllo se c'è un messaggio diverso dal default
    if(empty($messaggioErrore)) {
        $risposta = risposta_badInput("Errore! Richiesta al server è formulata in modo errato");
    } else {
        $risposta = risposta_badInput($messaggioErrore);
    }
    return $risposta; // Invio la risposta
}

/** ELEMENTO NON TROVATO NEL DATABASE */
function sayNotFound($messaggioErrore) {
    // Controllo se c'è un messaggio diverso dal default
    if(empty($messaggioErrore)) {
        $risposta = risposta_notFound("Errore! Non è stato trovato niente nel database");
    } else {
        $risposta = risposta_notFound($messaggioErrore);
    }
    return $risposta; // Invio la risposta
}

/** COSTRUZIONE RISPOSTA */
function risposta_badInput($messagge) {
    $risposta = 'console.log('. $messagge .');'
        . '<div class="errorDiv"><div class="warningSignal"><label class="errorMessage">'
        . $messagge . '</label><button id="errorButton">Chiudi</button></div></div>';

    return $risposta;
}

/** COSTRUZIONE RISPOSTA */
function risposta_notFound($messagge) {
    $risposta = 'console.log('. $messagge .');'
        . '<div class="errorDiv"><div class="errorSignal"><label class="errorMessage">'
        . $messagge . '</label><button id="errorButton">Chiudi</button></div></div>';

    return $risposta;
}

/** GENERA STRINGHE CASUALI */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}