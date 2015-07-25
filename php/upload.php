<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 23/07/2015
 * Time: 16:38
 */

include 'common.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipoDati = $_POST['dataType'];

    if(!empty($tipoDati)) {

        $tipoDati = SafeInput($tipoDati);

        if(preg_match('/^[a-zA-Z]*$/',$tipoDati)) {

        }
        else {
            response_client_error("Input errato! Variabile datatype contiene caratteri non validi");
        }
    }
    else {
        response_client_error("Input errato! Variabile dataType è vuota.");
    }

}