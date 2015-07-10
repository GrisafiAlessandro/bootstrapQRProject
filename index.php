<?php
function Safe_Input($data) {
   // $data = trim($data," "); // Aggiunge dei simboli alla fine...
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/* analisi richiesta documento */
if($_SERVER['REQUEST_METHOD'] == "GET") {
	$idDocumento = $_GET['d'];
	if(!empty($idDocumento)) {
        $idDocumento = Safe_Input($idDocumento);

        if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
            include "php/request_support.php";
            $risposta = getDocumento($idDocumento);
            if($risposta == null)
                $GLOBALS['risposta'] = 'getDocumento($idDocumento)non riceve un niente';
            else
                $GLOBALS['risposta'] = $risposta;
        }
        else {
            $GLOBALS['risposta'] = 'input sbagliato';
        }
    }
}
?>
<!DOCTYPE html>
<!--[if IE8] -->
<html>
<head>
    <meta lang="it">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="ITST J.F.KENNEDY">
    <meta name="keywords" content="Document,Certification,,ITST Kennedy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification Service</title>
    <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/index.css">
    <link rel="stylesheet" type="text/css" media="device and (max-width: 450px)" href="css/small.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 451px)" href="css/medium.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 900px)" href="css/large.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 1400px)" href="css/ultra-large.css">
    <link rel="stylesheet" type="text/css" media="(max-width: 900) and (orientation: portrait)" href="css/portrait.css">
    <link rel="stylesheet" type="text/css" media="(orientation: landscape)" href="css/landscape.css">
    <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jQuery_server_request.js"></script>
    <script src="js/jQuery_design.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="">
        <button id="btnInfoD" class="ui-btn ui-corner-all ui-icon-info ui-btn-icon-notext ui-btn-a"></button>
        <button id="btnAllD" title="Tutti i certificati" class="ui-btn ui-corner-all ui-icon-bars ui-btn-icon-notext ui-btn-a"></button>
        <button id="btnSearch" title="Ricerca" class="ui-btn ui-corner-all ui-icon-search ui-btn-icon-notext ui-btn-a"></button>
        <!-- MODULO DI RICERCA -->
        <div id="searchModule">
            <!-- Barra di ricerca -->
            <div id="divSearchBar">
                <label id="lblRicerca" >Ricerca</label>
                <input id="searchBar" type="text" name="searchString">
                <div id="searchResponse">
                </div>
            </div>
            <!-- Radio button per il tipo di ricerca-->
            <div id="divSearchType">
                <input type="radio" name="tipo">
                <label id="lblPerTipo" for="type">Per tipo</label>
                <input type="radio" name="data">
                <label id="lblPerData" for="date">Per data</label>
                <input type="radio" name="title">
                <label id="lblPerTitolo" for="titolo">Per titolo</label>
            </div>
        </div>
        <img id="logo" title="ITST J.F.Kennedy" src="fonts/logo.jpg">
        <button id="btnCopyright" title="Copyright" class="ui-btn ui-corner-all ui-icon-alert ui-btn-icon-notext ui-btn-a"></button>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <section id="sectionInfoDoc">
                    <?php echo $GLOBALS['risposta']; ?>
                </section>
            </div>
            <div class="col-md-6">
                <section id="sectionImgDoc" >
                    <?php echo getImage($idDocumento); ?>
                </section>
            </div>
         </div>
    </div>
</body>
</html>
