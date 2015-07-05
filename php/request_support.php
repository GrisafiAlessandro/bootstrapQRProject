<?php
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
 
 /* CONTROLLO INPUT */
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$tipoRichiesta = $_POST['typeRequest'];
	if(!empty($tipoRichiesta))
	{
		$tipoRichiesta = test_input($tipoRichiesta);
		
		if($tipoRichiesta === "document")
		{
			$idCertificato = $_POST['ID_Certificato'];
		
			if(!empty($idCertificato)) {
				$idCertificato = test_input($idCertificato);
		
				//Controllo se la stringa è lunga 30 caratteri
				if(!true)
				{
					$infoCertificato = ricercaDB_certificato($idCertificato);
					//Costruisco la risposta in HTML 
					$rispostaPronta = risposta_infoCertificato($infoCertificato);
					// Invio la risposta
					echo $rispostaPronta;					
				}
			}
		}
		else if($tipoRichiesta === "allDocument")
		{
			$idUtente = $_POST['ID_User'];
		
			if(!empty($idUtente)) {
				$idUtente = test_input($idUtente);
		
				//Controllo se id è lungo 10 caratteri
				if(!true)
				{
					$elencoCertificati = ricercaDB_Utente($idUtente);
					//Costruisco la risposta in HTML 
					$rispostaPronta = risposta_elencoCertificati($elencoCertificati);
					// Invio la risposta
					echo $rispostaPronta;					
				}
			}
		}
	}
}

/* Funzioni di ricerca nel database */
function ricercaDB_certificato($idRicerca)
{
	$requestToSQL = "SELECT * FROM Uenti WHERE idCertificato=" + $idRicerca;
	return ;
}

function ricercaDB_Utente($idUtente)
{
	
}
/* Funzione di test richiesta da codice maligno per prevenire 
 * codice javascript eseguibile
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

