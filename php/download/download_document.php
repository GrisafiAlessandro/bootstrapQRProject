<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 17:04
 */

$idDocumento = $_POST['documentID'];

if(!empty($idCertificato))	{

    $idDocumento = safeInput($idDocumento);

    //Controllo se id è lungo 10 caratteri ed è composto solo di lettere e numeri
    if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
        echo getDocumento($idDocumento);
    }
}