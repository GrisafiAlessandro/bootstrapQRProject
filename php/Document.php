<?php
/**
 * Created by PhpStorm.
 * User: Bogdan
 * Date: 06/07/2015
 * Time: 16:50
 */

class Document {
    public $idDocumento = null;
	public $idUtente = null;
    public $titolo = null;
    public $luogoRilascio = null;
    public $dataRilascio = null;
	
    public $imgLocation = null;	// PATH all'immagine;
    
	// Campi per il controllo
    public $isCertificato = false;
	public $isAttestato = false;
	
	//Campi certificato corso    
    public $idCorso = null;		//Indice id del corso    
    
	//campi Attestato
    public $risultatoAttestato = null;
	public $descrizione = null;    
}