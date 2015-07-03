<?php

?>

<!DOCTYPE html>
<!--[if IE8] -->
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Certification Service</title>
<link type="text/css" href="css/bootstrap.css">

<script type="text/javascript">

</script>

</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>s

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
            
            <div id="utente_titolo"></div>
            <div id="identitaUtente">
                <div id="utente_nome"></div>
                <div id="utente_cognome"></div>
            </div>
            
            <div id="utente_luogoRilascio"></div>
            <div id="utente_dataRilascio"></div>
            <div id="utente_durataCorso"></div>
            <div id="utente_identitaDocente"></div>
            <div id="utente_descrizione"></div>
            </section>
        </div>
        <div class="col-md-4">
            <section id="sectionFotoCertificato" >
                <img id="imgCertificato" title="<?php echo certificate.title; ?>" src="<?php echo $certificate.photoLocation; ?>"/>
            </section>
        </div>
    </div>
</div>

</body>
</html>
