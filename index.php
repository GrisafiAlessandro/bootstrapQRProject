<?php

function Safe_Input($data) {
   // $data = trim($data," ");
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
            include "php/request_support.php";
            $risposta = getDocumento($idDocumento);
            if($risposta == null)
                $GLOBALS['risposta'] = 'getDocumento($idDocumento)non riceve un niente';
            else
                $GLOBALS['risposta'] = $risposta;
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
    <link type="text/css" href="css/index.css" media="all">
    <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jQuery_server_request.js"></script>
    <script src="js/jQuery_design.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<script>
    $(function(){
        $( "div#imgDoc" ).swiperight( function ( ){
            $( "div#menuLat" ).addClass( "swiperight" );
            $( "div#buttonMenu" ).addClass( "swiperightButton" );
            window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swipeleft");},2);
            window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swipeleftButton");},2);
        })
    });

    //Swipe left menu
    $(function(){
        $( "div#row div").swipeleft( function ( ){

            $( "div#menuLat" ).addClass( "swipeleft" );
            $( "div#buttonMenu" ).addClass( "swipeleftButton" );
            window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swiperight");},2);
            window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swiperightButton");},2);
        })
    });

    $(function() {
        var x = 1;
        $( "button#buttonInfo" ).tap( function ( ){
            if(x==1)
            {
                $( "div#menuLat" ).addClass( "swiperight" );
                $( "div#buttonMenu" ).addClass( "swiperightButton" );
                $(function (){
                    $("button#buttonInfo").removeClass("ui-icon-info").addClass("ui-icon-home");});
                window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swipeleft");},2);
                window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swipeleftButton");},2);
                x=2;
            }
            else
            {
                $( "div#menuLat" ).addClass( "swipeleft" );
                $( "div#buttonMenu" ).addClass( "swipeleftButton" );
                $(function (){
                    $("button#buttonInfo").removeClass("ui-icon-home").addClass("ui-icon-info");});
                window.setTimeout(function(){ $( "div#menuLat" ).removeClass("swiperight");},2);
                window.setTimeout(function(){ $( "div#buttonMenu" ).removeClass("swiperightButton");},2);
                x=1;
            }
        })
    });
</script>
    <div>
        <button id="btnAllDocumnets" title="Tutti i certificati" ></button>

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
    </div>

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
                    <?php echo getImage($idDocumento); ?>
                </section>
            </div>
         </div>
    </div>
</body>
</html>
