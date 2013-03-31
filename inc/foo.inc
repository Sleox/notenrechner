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

?>