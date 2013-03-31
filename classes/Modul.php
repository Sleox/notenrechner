<?php

/**
 * Klasse repräsentiert
 * ein Studien-Modul
 * mit Semester, Note, CP und
 * Gewichtung. Berechnet Modulnote
 * anhand von Klausur + Praktikum
 *
 */
class Modul {
    
    // Sonderfälle Konstanten
    const PRAKTIKUM_FEHLT = 6;
    const KLAUSUR_FEHLT = 7;
    const OK = 8;
    
    // Attribute
    public $semester;
    public $note;
    public $cp;
    public $note_praktikum;
    public $note_klausur;
    public $gewicht;
    
    // Konstruktor
    public function Modul($semester, $cp){
	$this->semester = $semester;
	$this->cp = $cp;
	
	if ($semester <= 3)
	    $this->gewicht = 1;
	elseif ($semester <= 5)
	    $this->gewicht = 2;
	else
	    $this->gewicht = 3;
	    
    }
    
    // Note setzen
    // Falls kein Praktikum, nur eine Note,
    // Fälle wie Klausur Fehlt oder Praktikum Fehlt
    // werden berücksichtigt
    public function setNote($note, $praktikum = false, $fall = self::OK){
	switch($fall){
	    case self::OK:
		if($praktikum){
		    $this->note_praktikum = $praktikum;
		    $this->note_klausur = $note;
		    $this->note = ($praktikum * 3 + $note * 7) / 10;
		    // Runden nach Prüfungsordnung
		    $this->note = floor($this->note * 10) / 10;
		}else{
		    $this->note = $note;
		}
		break;
	    case self::KLAUSUR_FEHLT:
		$this->cp = $this->cp - ($this->cp * 0.7);
		$this->note = $praktikum;
		break;
	    case self::PRAKTIKUM_FEHLT:
		$this->cp = $this->cp - ($this->cp * 0.3);
		$this->note = $note;
		break;
	}
	
	
    }
    
    // Gibt Noten-Objekt zurück
    // Dieses enthält die Note, Credits und Gewicht
    public function getNote(){
	return new Note($this->note, $this->cp, $this->gewicht);
    }
    
}


?>