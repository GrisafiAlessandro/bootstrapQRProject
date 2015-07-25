<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:03
 */

$idUtente = $GLOBALS['userID'];

if(!empty($idUtente)) {
    $idUtente = safeInput($idUtente);

    //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
    if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
        echo getDocente($idUtente);
    }
}