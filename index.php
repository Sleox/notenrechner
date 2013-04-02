<?php


/**
 * Notenrechner App
 * Für Medieninformatik-Studenten
 * der Hochschule RheinMain
 *
 */

// Includes
require_once "classes/Modul.php";
require_once "classes/Note.php";
require_once "classes/Notenrechner.php";
require_once "inc/foo.inc";

// Html Datei laden
$html = file_get_contents("template/layout.html");

// Notenrechner instanzieren
$nr = new Notenrechner();

// Request Semester 1
requestModul($nr, "einf_mi", 1, 5);
requestModul($nr, "proggn1", 1, 7);
requestModul($nr, "analysis", 1, 5, false);
requestModul($nr, "einf_g", 1, 8, false);
requestModul($nr, "grund_bwl", 1, 5, false);


// Request Semester 2
requestModul($nr, "ads", 2, 5);
requestModul($nr, "proggn2", 2, 5);
requestModul($nr, "ausz", 2, 5);
requestModul($nr, "elek_medien", 2, 5, false);
requestModul($nr, "la", 2, 5, false);
requestModul($nr, "recht", 2, 5, false);

// Request Semester 3
requestModul($nr, "afs", 3, 5, false);
requestModul($nr, "proggn3", 3, 5);
requestModul($nr, "mfi", 3, 5, false);
requestModul($nr, "dbs", 3, 5);
requestModul($nr, "anim", 3, 5, false);
requestModul($nr, "eib", 3, 5);

// Request Semester 4
requestModul($nr, "cg", 4, 5);
requestModul($nr, "rn", 4, 5);
requestModul($nr, "web", 4, 5);
requestModul($nr, "mci", 4, 5, false);
requestModul($nr, "bsra", 4, 5);
requestModul($nr, "swt", 4, 5);

// Request Semester 5
requestModul($nr, "swtpro", 5, 10, false);
requestModul($nr, "fs", 5, 5, false);
requestModul($nr, "liste_g", 5, 10, false);
requestModul($nr, "liste_mi", 5, 10, false);

// Request Semester 6
requestModul($nr, "thesis", 6, 15, false);


// Ausgaben
ausgabe($nr, &$html);





?>