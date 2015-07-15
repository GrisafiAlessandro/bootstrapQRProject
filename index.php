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
   <!-- <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css">-->
    <link rel="stylesheet" type="text/css" media="all" href="css/index.css">
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 450px)" href="css/small.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 451px)" href="css/medium.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 900px)" href="css/large.css">
    <link rel="stylesheet" type="text/css" media="(min-width: 1400px)" href="css/ultra-large.css">
    <link rel="stylesheet" type="text/css" media="(max-width: 900) and (orientation: portrait)" href="css/portrait.css">
    <link rel="stylesheet" type="text/css" media="(orientation: landscape)" href="css/landscape.css">

    <!--   <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jQuery_server_request.js"></script>
    <script src="js/jQuery_design_event.js"></script>
    <script src="js/jQuery_design_animations.js"></script>
 <!--   <script src="js/bootstrap.min.js"></script>-->
</head>
<body>
    <header class="">
        <nav>
        <button id="btnInfoD">
            <svg viewBox="0 0 24 24">
                <path fill="#000000" d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
            </svg>
        </button>
        <button id="btnAllD" title="Tutti i certificati" >
            <svg viewBox="0 0 24 24">
                    <path fill="#000000" d="M4,5V7H21V5M4,11H21V9H4M4,19H21V17H4M4,15H21V13H4V15Z" />
            </svg>
        </button>
        <button id="btnSearch" title="Ricerca" >
            <svg viewBox="0 0 24 24">
                <path fill="#000000" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
            </svg>
        </button>
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
                <label id="lblPerTipo" for="tipo">Per tipo</label>
                <input type="radio" name="data">
                <label id="lblPerData" for="date">Per data</label>
                <input type="radio" name="title">
                <label id="lblPerTitolo" for="titolo">Per titolo</label>
            </div>
        </div>
        <img id="logo" title="ITST J.F.Kennedy" src="fonts/logo.jpg">
        <button id="btnCopyright" title="Copyright" >
            <svg viewBox="0 0 49 49" fill="none" stroke="black">
                <circle cx="24" cy="24" r="21.24" stroke-width="5.52"/>
                <circle cx="24" cy="24" r="10.2" stroke-width="5.52" />
                <rect  x="30" y="21" fill="#FFFFFF" width="8" height="7" stroke="white" stroke-width="0.5"/>
            </svg>
        </button>
    </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <section id="sectionInfoDoc">
                    <?php echo $GLOBALS['risposta']; ?>
                </section>
            </div>
            <div class="col-lg-6">
                <section id="sectionImgDoc" >
                    <?php echo getImage($idDocumento); ?>
                </section>
            </div>
         </div>
    </div>
</body>
</html>
