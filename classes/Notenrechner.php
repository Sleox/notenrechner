<?php

/**
 * Notenrechner Klasse
 * zum hinzufügen von
 * Modulen und errechnen
 * der Gesamtnote
 *
 */
class Notenrechner {
    
    // Module
    private $module;
    
    // Konstruktor
    public function Notenrechner(){
	$this->module = array();
    }
    
    // Ein Modul hinzufügen nach
    // Semester, cp, note, praktikum und sonderfall
    public function addModul($semester, $cp, $note, $note_praktikum = false, $fall = Modul::OK){
	$modul = new Modul($semester, $cp);
	$modul->setNote($note, $note_praktikum, $fall);
	$this->module[] = $modul;	
    }
    
    // Gesamtnote ausrechnen, nach PO 2010
    public function getGesamtNote(){
	$noten = array();
	
	foreach($this->module as $modul){
	    $noten[] = $modul->getNote();
	}
	
	$gesamt_cp = 0;
	$summe_noten = 0;
	foreach($noten as $note){
	    $summe_noten += $note->note * $note->gewicht * $note->cp;
	    $gesamt_cp += $note->cp * $note->gewicht;	    
	}
	
	if($gesamt_cp){
	    $note = $summe_noten / $gesamt_cp;
	    // Runde Note Prüfungsordnungs-konform
	    return floor($note * 10) / 10;
	}
	else{
	    return null;
	}
	
    }
    
    
    
}

?>