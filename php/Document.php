<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 06/07/2015
 * Time: 16:50
 */

class Document
{
    public $titolo = null;
    public $nome= null;
    public $cognome = null;
    public $luogoRilascio = null;
    public $dataRilascio = null;

    //Campi certificato corso
    public $isCertificato = false;
    public $durataCorso = null;
    public $descrizione = null;
    //Chiave id l'insegnante
    public $identitaDocente = null;


    //campi Attestato
    public $isAttestato = false;
    public $risultatoAttestato = null;

    // PATH all'immagine
    public $imgLocation = null;
}