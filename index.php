<?php 
/*analisi richiesta cerificato*/

if($_SERVER['REQUEST_METHOD'] == "GET") {
	
	$idCertificato = $_GET['ID_Certificato'];
	
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
?>

<!DOCTYPE html>
<!--[if IE8] -->
<html>
<head>
    <meta lang="it">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Certification Service</title>
    <link type="text/css" href="css/bootstrap.css" media="all">
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jQuery_server_request.js"></script>
<script src="js/jQuery_design.js"></script>

    <header>
        <button id="btnAllCertiicate" title="Tutti i certificati" ></button>

        <!-- Ricerca -->
        <div id="divRicerca">
            <label id="lblRicerca" >Ricerca</label>
            <input id="searchBar" type="text" name="searchString">
        </div>

        <!-- le radio button per il tipo di ricerca-->
        <div>
            <input type="radio" name="type">
            <label id="lblPerTipo" for="type">Per tipo</label>
            <input type="radio" name="date">
            <label id="lblPerData" for="date">Per data</label>
            <input type="radio" name="title">
            <label id="lblPerTitolo" for="title">Per titolo</label>
        </div>

        <button id="copyrightButton" title="Copyright" ></button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <aside id="continerAside">
                </aside>
            </div>

            <div class="col-md-4">
                <section id="sectionInfoCertificato">
                    <div id="utente_titolo"><?php echo $_GLOBALS['certificato']->titolo; ?></div>
                    <div id="identitaUtente">
                        <div id="utente_nome"><?php echo $_GLOBALS['certificato']->nome; ?></div>
                        <div id="utente_cognome"><?php echo $_GLOBALS['certificato']->cognome; ?></div>
                    </div>

                    <div id="utente_luogoRilascio"><?php echo $_GLOBALS['certificato']->luogoRilascio; ?></div>
                    <div id="utente_dataRilascio"><?php echo $_GLOBALS['certificato']->dataRilascio; ?></div>

                    <?php
                    /*Stampa se è un certificato di un corso*/
                    if($_GLOBALS['certificato']->isCertificato) {
                        echo '<div id="utente_durataCorso">', $_GLOBALS['certificato']->durataCorso, '</div>
                        <div id="utente_identitaDocente">', $_GLOBALS['certificato']->identitaUtente, '</div>';
                    } ?>
                    <div id="utente_descrizione"><?php echo $_GLOBALS['certificato']->descrizione; ?></div>
                </section>
            </div>
            <div class="col-md-4">
                <section id="sectionFotoCertificato" >
                    <img alt=" " id="imgCertificato" title="<?php echo $_GLOBALS['certificato']->titolo; ?>" src="<?php echo $_GLOBALS['certificato']->imgLocation; ?>" />
                </section>
            </div>
<<<<<<< HEAD
            
            <div id="utente_luogoRilascio"><?php echo $_GLOBALS['certificato']->luogoRilascio; ?></div>
            <div id="utente_dataRilascio"><?php echo $_GLOBALS['certificato']->dataRilascio; ?></div>
            
			<?php 
			/*Stampa se è un certificato di un corso*/
			if($_GLOBALS['certificato']->isCertificato) {
				echo '<div id="utente_durataCorso">', $_GLOBALS['certificato']->durataCorso, '</div>
				<div id="utente_identitaDocente">', $_GLOBALS['certificato']->identitaUtente, '</div>';
            } ?>
            <div id="utente_descrizione"><?php echo $_GLOBALS['certificato']->descrizione; ?></div>
            
            </section>
        </div>
        <div class="col-md-4">
            <section id="sectionFotoCertificato" >
                <img alt="<?php echo $_GLOBALS['certificato']->titolo; ?>" id="imgCertificato" src="<?php echo $_GLOBALS['certificato']->imgLocation; ?>">
            </section>
=======
>>>>>>> origin/master
        </div>
    </div>
</body>
</html>
