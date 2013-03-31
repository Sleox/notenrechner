<?php


/**
 * Notenrechner App
 * Für Medieninformatik-Studenten
 * der Hochschule RheinMain
 *
 */

require_once "classes/Modul.php";
require_once "classes/Note.php";
require_once "classes/Notenrechner.php";
require_once "inc/foo.inc";

$html = file_get_contents("template/layout.html");
$nr = new Notenrechner();

// Request Semester 1
requestModul($nr, "einf_mi", 1, 5);
requestModul($nr, "proggn1", 1, 7);
requestModul($nr, "analysis", 1, 5, false);
requestModul($nr, "einf_g", 1, 8);
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

$note = $nr->getGesamtNote();


$savebox = file_get_contents("template/save.html");
$savebox = str_replace("{link}", $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'], $savebox);
if($note === null){
    $html = str_replace("{note}", "<p>Bitte Noten eintragen</p>", $html);
}else if($note <= 1.3){    
    $html = str_replace("{note}", "<h1>". $note . "</h1><p>ohne gewähr</p><p>Respekt!</p>" . $savebox, $html);
}else if($note <= 2.0){
    $html = str_replace("{note}", "<h1>". $note . "</h1><p>ohne gewähr</p><p>Top!</p>" . $savebox, $html);
}else if($note <= 2.3){
    $html = str_replace("{note}", "<h1>". $note . "</h1><p>ohne gewähr</p><p>Gute Leistung!</p>" . $savebox, $html);
}else if($note <= 2.7){
    $html = str_replace("{note}", "<h1>". $note . "</h1><p>ohne gewähr</p><p>Ok!</p>". $savebox, $html);
}else{
    $html = str_replace("{note}", "<h1>". $note . "</h1><p>ohne gewähr</p><p>Das geht doch besser!</p>". $savebox, $html);
}


echo $html;





?>