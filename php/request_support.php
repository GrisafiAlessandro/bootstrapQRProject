<?php

$GLOBALS['$servername'] = "localhost";
$GLOBALS['$username'] = "lbTest";
$GLOBALS['$password'] = "alphabetagamma";
$GLOBALS['dbname'] = "DB_Sistema";

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
 *  requestType = document/allDocuments/user
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

 /* CONTROLLO INPUT */
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$tipoRichiesta = $_POST['typeRequest'];
	if(!empty($tipoRichiesta))	{
		$tipoRichiesta = test_input($tipoRichiesta);

        /** Richiesta un documento specifico */
		if($tipoRichiesta === "document") {
			$idCertificato = $_POST['ID_Certificato'];

			if(!empty($idCertificato))	{

				$idCertificato = test_input($idCertificato);

				//* Controllo se la stringa è lunga 30 caratteri

				if(30 == strlen($idCertificato) && preg_match("/^[a-zA-Z0-9]+$/",$idCertificato) )	{

					$infoCertificato = ricercaDB_certificato($idCertificato);
					//Costruisco la risposta in HTML
					$rispostaPronta = risposta_infoCertificato($infoCertificato);
					// Invio la risposta
					echo $rispostaPronta;
				}
			}
		}

        /**  Richiesta di tutti i documenti di un utente */
		else if($tipoRichiesta === "allDocuments") {

			$idUtente = $_POST['ID_User'];

			if(!empty($idUtente)) {
				$idUtente = test_input($idUtente);

				//Controllo se id è lungo 10 caratteri

				if( 10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
					// Ricerco utente
					$infoUtente = ricercaDB_Utente($idUtente);
					//Costruisco la risposta in HTML
					$rispostaPronta = risposta_elencoCertificati($infoUtente);
					// Invio la risposta
					echo $rispostaPronta;
				}
			}
		}
        /** Richiesta info docente */
		else if($tipoRichiesta === "user") {
			$idUtente = $GLOBALS['ID_User'];

			if(!empty($idUtente)) {
				$idUtente = test_input($idUtente);

				if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente)) {
					// Ricerco info cliente
					$infoUtente = ricercaDB_Utente($idUtente);

					// Costruisco la risposta
					$rispostaPronta = risposta_CertificatiInsegnante($infoUtente);

					// Invio la risposta
					echo $rispostaPronta;
				}
			}
		}
		else if($tipoRichiesta === "user")
		{
			$idUtente = $GLOBALS['ID_User'];
			
			if(!empty($idUtente)) 
			{
				$idUtente = test_input($idUtente);
				
				if(10 == strlen($idUtente) && preg_match("/^[a-zA-Z0-9]+$/",$idUtente))
				{
					// Ricerco info cliente
					$infoUtente = ricercaDB_Utente($idUtente);
					
					// Costruisco la risposta
					$rispostaPronta = risposta_CertificatiInsegnante($infoUtente);		
					
					// Invio la risposta
					echo $rispostaPronta;	
				}	
			}
		}
	}
}

/** Funzioni di ricerca nel database */


function ricercaDB_certificato($idCertificato) {
    include "php/Document.php";
    $rispostaCostruita = new Document();

	$requestToSQL = "SELECT * FROM Users WHERE idCertificato=" . $idCertificato;

    // Create connection
    $conn = new mysqli($GLOBALS['$servername'], $GLOBALS['$username'], $GLOBALS['$password'], $GLOBALS['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $conn->close();
	return ;
}

// Ricerca l'utente
function ricercaDB_Utente($idUtente) {

}

/** Funzioni di costruzioni delle risposte */

function risposta_infoCertificato($infoCertificato) {

}

function risposta_elencoCertificati($elencoCertificati) {

}

/** Funzione di test richiesta da codice maligno per prevenire
 * codice javascript eseguibile
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

