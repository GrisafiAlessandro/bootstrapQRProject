<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 06/07/2015
 * Time: 16:50
 */

class Document {
    public $idDocumento = null;
    public $titolo = null;
    public $nome = null;
    public $cognome = null;
    public $luogoRilascio = null;
    public $dataRilascio = null;

    //Campi certificato corso
    public $isCertificato = false;
    //Chiave id dell'insegnante

    public $idCorso = null;
    public $durataCorso = null;
    public $descrizione = null;
    public $isAttestato = false;
    public $idDocente = null;
    public $risultatoAttestato = null;
    // PATH all'immagine;

    //campi Attestato
    public $imgLocation = null;
}