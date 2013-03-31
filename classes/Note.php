<?php

    /**
     * Klasse repräsentiert
     * eine Note.
     */
    class Note {
	
	public $note, $cp, $gewicht;
	
	public function Note($note, $cp, $gewicht){
	    $this->note = $note;
	    $this->cp = $cp;
	    $this->gewicht = $gewicht;
	}
    }
    
?>