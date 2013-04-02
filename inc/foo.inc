<?php

    function requestModul($notenrechner, $key, $sem, $cp, $praktikum = true){
	if($praktikum){
	    if(req($key) && req($key . "_p")){
		$notenrechner->addModul($sem, $cp, req($key), req($key . "_p"));
	    }else if(req($key)){
		$notenrechner->addModul($sem, $cp, req($key), false, Modul::PRAKTIKUM_FEHLT);
	    }else if(req($key . "_p")){
		$notenrechner->addModul($sem, $cp, false, req($key . "_p"), Modul::KLAUSUR_FEHLT);
	    }
	}else{
	    if(req($key)){
		$notenrechner->addModul($sem, $cp, req($key));
	    }
	}
    }
    
    function req($v){
	global $html;
	if (empty($_GET[$v])){
	    $html = str_replace("{" . $v . "}", "", $html);
	    return false;
	}
	else{
	    // Komma mit Punkt ersetzen
	    $_GET[$v] = str_replace(",", ".", $_GET[$v]);
	    $_GET[$v] = floor($_GET[$v] * 10) / 10;
	    if($_GET[$v] == 5){
		$html = str_replace("{" . $v . "}", "", $html);
		return false;
	    }
	    $_GET[$v] > 5 ? $_GET[$v] = 5 : null;
	    $_GET[$v] < 1 ? $_GET[$v] = 1 : null;
	    $html = str_replace("{" . $v . "}", floatval($_GET[$v]), $html);
	    return floatval($_GET[$v]);
	}
    }
    
    

    function ausgabe($nr, $html){
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
	
	// Ausgabe, fertig
	echo $html;
	
    }


?>