<?php

function Safe_Input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/*analisi richiesta cerificato*/
if($_SERVER['REQUEST_METHOD'] == "GET") {

	$idDocumento = $_GET['d'];

	if(!empty($idDocumento)) {
        $idDocumento = Safe_Input($idDocumento);

        if(30 == strlen($idDocumento) && preg_match("/^[a-zA-Z0-9]+$/",$idDocumento) )	{
            include_once "php/request_support.php";
            $GLOBALS['risposta'] = '$getDocumento($idDocumento)non riceve un cazzo';
        }
        else {
            echo 'proprio non voglio';
        }
    }
}
?>

<!DOCTYPE html>
<!--[if IE8] -->
<html lang="it">
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
            <div id="searchResponse" >
            </div>
        </div>

        <!-- le radio button per il tipo di ricerca-->
        <div>
            <input type="radio" name="tipo">
            <label id="lblPerTipo" for="type">Per tipo</label>
            <input type="radio" name="data">
            <label id="lblPerData" for="date">Per data</label>
            <input type="radio" name="title">
            <label id="lblPerTitolo" for="titolo">Per titolo</label>
        </div>

        <button id="copyrightButton" title="Copyright"  ></button>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <aside id="continerAside">
                </aside>
            </div>

            <div class="col-md-4">
                <section id="sectionInfoDocumento">
                    <?php echo $GLOBALS['risposta']; ?>
                </section>
            </div>
            <div class="col-md-4">
                <section id="sectionImgDocumento" >
                    <?php echo '$getImage($idDocumento)'; ?>
                </section>
            </div>
         </div>
    </div>
</body>
</html>
