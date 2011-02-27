<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
Atomik::flash('Et ole kirjautunut sis&auml;&auml;n tai k&auml;ytt&ouml;oikeustasosi ei ole riitt&auml;v&auml;','error');
	Atomik::redirect('login');
}

		//If user not administrator, can edit only dog of his own
if ($_SESSION['usergroup'] != 1) {
	$tarkistus = Atomik_Db::query('select omistaja from koirat where koirat.reknro=?',array($_GET['reknro']));
		//This dog's owner email into an apu variable
	foreach($tarkistus as $apu):
		$omistajanemail = $apu['omistaja'];
	endforeach;
	
		//Evaluate if user is really the owner of this dog
	if ($_SESSION['email'] != $omistajanemail) {
		Atomik::flash('Sinulla ei ole oikeuksia valitsemasi koiran tietojen muuttamiseen','error');
		echo $_SESSION['email'];
	Atomik::redirect('listdogs');
	}
}


//Query the dog information and results from db, regnr passed as parameter in url

$dogs = Atomik_Db::query('select * from koirat LEFT JOIN koirien_tulokset ON koirat.reknro=koirien_tulokset.koira where koirat.reknro=?',array($_GET['reknro']));
$owners = Atomik_Db::query('select email from kayttajat'); 

//Creating an array of owners from an object

$i = 0;
foreach($owners as $owner):
   $taulu[$i] = $owner['email'];
   $i++;
endforeach;

//Initialize and set this dog's information from array to variables
  
foreach ($dogs as $dog):
$reknro = $dog['reknro'];
$nimi = $dog['nimi'];
$syntynyt = $dog['syntynyt'];
$vari = $dog['vari'];
$isa = $dog['isa'];
$ema = $dog['ema'];
$rotu = $dog['rotu'];
$omistaja = $dog['omistaja'];
$koiran_tila = $dog['koiran_tila'];
$selkatulos = $dog['selkatulos'];
$selka_huom = $dog['selka_huom'];
$selka_vaaraika = $dog['selka_vaaraika'];
$polvitulos = $dog['polvitulos'];
$nayttelytulos = $dog['nayttelytulos'];
$koetulos_lut = $dog['koetulos_lut'];
$koetulos_maaj = $dog['koetulos_maaj'];
$koetulos_lume = $dog['koetulos_lume'];
$koetulos_veri = $dog['koetulos_veri'];
$koetulos_pika = $dog['koetulos_pika'];
$koetulos_meja = $dog['koetulos_meja'];
$koetulos_vahi = $dog['koetulos_vahi'];
$koetulos_hirvj = $dog['koetulos_hirvj'];
endforeach;

//---------------------------------ROTU PART BEGIN--------------
	
	// Initialize rotu type variables

$kkka_sel = '';
$lkka_sel = '';
$pkka_sel = '';
$kkk_sel = '';
$lkk_sel = '';
$pkk_sel = '';
$kk_sel = '';
$lk_sel = '';
$pk_sel = '';

	//Setting existing values from db for form field default

if ($rotu == 'KKKA') {
		$kkka_sel = ' SELECTED';
	} elseif ($rotu == 'LKKA') {
		$lkka_sel = ' SELECTED';
	} elseif ($rotu == 'PKKA') {
		$pkka_sel = ' SELECTED';
	} elseif ($rotu == 'KKK') {
		$kkk_sel = ' SELECTED';
	} elseif ($rotu == 'LKK') {
		$lkk_sel = ' SELECTED';
	} elseif ($rotu == 'PKK') {
		$pkk_sel = ' SELECTED';
	} elseif ($rotu == 'KK') {
		$kk_sel = ' SELECTED';
	} elseif ($rotu == 'LK') {
		$lk_sel = ' SELECTED';
	} elseif ($rotu == 'PK') {
		$pk_sel = ' SELECTED';
	} else {}
//---------------------------------ROTU PART END--------------


//---------------------------------DOG SHOW RESULT PART BEGIN--------------
	
	// Initialize show result variables

$cib_sel = '';
$fimva_sel = '';
$cacib_sel = '';
$vacacib_sel = '';
$sert_sel = '';
$vasert_sel = '';
$eri_sel = '';
$eh_sel = '';
$h_sel = '';
$t_sel = '';

	//Setting existing values from db for form field default

if ($nayttelytulos == 'CIB') {
		$cib_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'FI MVA') {
		$fimva_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'CACIB') {
		$cacib_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'VACACIB') {
		$vacacib_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'SERT') {
		$sert_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'VASERT') {
		$vasert_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'ERI') {
		$eri_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'EH') {
		$eh_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'H') {
		$h_sel = ' SELECTED';
	} elseif ($nayttelytulos == 'T') {
		$t_sel = ' SELECTED';
} else {}
//---------------------------------DOG SHOW RESULT PART END--------------



//---------------------------------LUT WORKING TEST PART BEGIN--------------

	//Initialize lut working test result variables

$kval_sel = '';
$luta_sel = '';
$lutb_sel = '';
$lutc_sel = '';
$lutd_sel = '';
$lute_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_lut == 'KVAL') {
		$kval_sel = ' SELECTED';
	} elseif ($koetulos_lut == 'LUTA') {
		$luta_sel = ' SELECTED';
	} elseif ($koetulos_lut == 'LUTB') {
		$lutb_sel = ' SELECTED';
	} elseif ($koetulos_lut == 'LUTC') {
		$lutc_sel = ' SELECTED';
	} elseif ($koetulos_lut == 'LUTD') {
		$lutd_sel = ' SELECTED';
	} elseif ($koetulos_lut == 'LUTE') {
		$lute_sel = ' SELECTED';
} else {}
//---------------------------------LUT WORKING TEST PART END--------------


//---------------------------------MÄAJ WORKING TEST PART BEGIN--------------

	//Initialize mäaj working test result variables

$kvaa_sel = '';
$maaj1_sel = '';
$maaj2_sel = '';
$maaj3_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_maaj == 'KVAA') {
		$kvaa_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ1') {
		$maaj1_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ2') {
		$maaj2_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ3') {
		$maaj3_sel = ' SELECTED';
} else {}
//---------------------------------MÄAJ WORKING TEST PART END--------------


//---------------------------------LUME WORKING TEST PART BEGIN--------------

	//Initialize lume working test result variables

$kvam_sel = '';
$lume1_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_lume == 'KVAM') {
	$kvam_sel = ' SELECTED';
} elseif ($koetulos_lume == 'LUME1') {
	$lume1_sel == ' SELECTED';
} else {}
//---------------------------------LUME WORKING TEST PART END--------------


//---------------------------------VERI WORKING TEST PART BEGIN--------------

	//Initialize veri working test result variables

$kvav_sel = '';
$veri1_sel = '';
$veri2_sel = '';
$veri3_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_veri == 'KVAV') {
		$kvav_sel = ' SELECTED';
	} elseif ($koetulos_veri == 'VERI1') {
		$veri1_sel = ' SELECTED';
	} elseif ($koetulos_veri == 'VERI2') {
		$veri2_sel = ' SELECTED';
	} elseif ($koetulos_veri == 'VERI3') {
		$veri3_sel = ' SELECTED';
} else {}
//---------------------------------VERI WORKING TEST PART END--------------


//---------------------------------PIKA WORKING TEST PART BEGIN--------------

	//Initialize pika working test result variables

$pika1_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_pika == 'PIKA1') {
		$pika1_sel = ' SELECTED';
} else {}
//---------------------------------PIKA WORKING TEST PART END--------------


//---------------------------------MEJÄ WORKING TEST PART BEGIN--------------

	//Initialize mejä working test result variables

$jva_sel = '';
$voi1_sel = '';
$voi2_sel = '';
$voi3_sel = '';
$avo1_sel = '';
$avo2_sel = '';
$avo3_sel = '';


	//Setting existing values from db for form field default

if ($koetulos_meja == 'JVA') {
		$jva_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'VOI1') {
	$voi1_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'VOI2') {
	$voi2_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'VOI3') {
	$voi3_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'AVO1') {
	$avo1_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'AVO2') {
	$avo2_sel = ' SELECTED';
	} elseif ($koetulos_meja == 'AVO3') {
	$avo3_sel = ' SELECTED';
} else {}
//---------------------------------MEJÄ WORKING TEST PART END--------------


//---------------------------------VAHI WORKING TEST PART BEGIN--------------

	//Initialize vahi working test result variables

$vahi1_sel = '';


	//Setting existing values from db for form field default

if ($koetulos_vahi == 'VAHI1') {
		$vahi1_sel = ' SELECTED';
} else {}
//---------------------------------VAHI WORKING TEST PART END--------------


//---------------------------------HIRV-J WORKING TEST PART BEGIN--------------

	//Initialize vahi working test result variables

$kvaj_sel = '';
$hirvj1_sel = '';

	//Setting existing values from db for form field default

if ($koetulos_hirvj == 'KVAJ') {
		$kvaj_sel = ' SELECTED';
}	elseif ($koetulos_hirvj == 'HIRVJ1') {
		$hirvj1_sel = ' SELECTED';
} else {}
//---------------------------------HIRV-J WORKING TEST PART END--------------

//---------------------------------KOIRAN_TILA PART BEGIN--------------
                                                                               
    //Initialize koiran_tila variables                            

$tila0_sel = '';
$tila1_sel = '';
$tila2_sel = '';

    //Setting existing values from db for form field default
                                                            
if ($koiran_tila == '0') {                            
        $tila0_sel = ' SELECTED';                            
}   elseif ($koiran_tila == '1') {                  
        $tila1_sel = ' SELECTED';                          
}   elseif ($koiran_tila == '2') {
        $tila2_sel = ' SELECTED';
} else {}                                                   
//---------------------------------KOIRAN_TILA PART END--------------

//---------------------------------SELKATULOS PART BEGIN--------------
                                                                               
    //Initialize selkatulos variables                            

$selkatulos0_sel = '';
$selkatulos1_sel = '';
$selkatulos2_sel = '';
$selkatulos3_sel = '';
$selkatulos4_sel = '';
$selkatulos5_sel = '';
$selkatulos6_sel = '';
$selkatulos7_sel = '';
$selkatulos8_sel = '';
$selkatulos9_sel = '';
$selkatulos10_sel = '';
$selkatulos11_sel = '';
$selkatulos12_sel = '';
$selkatulos13_sel = '';
$selkatulos14_sel = '';
$selkatulos15_sel = '';
$selkatulos16_sel = '';
$selkatulos17_sel = '';
$selkatulos18_sel = '';
$selkatulos19_sel = '';
$selkatulos20_sel = '';
$selkatulos21_sel = '';
$selkatulos22_sel = '';
$selkatulos23_sel = '';
$selkatulos24_sel = '';
$selkatulos25_sel = '';

    //Setting existing values from db for form field default
                                                            
if ($selkatulos == 'K0') {                            
        $selkatulos0_sel = ' SELECTED';                            
}   elseif ($selkatulos == 'K1') {                  
        $selkatulos1_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K2') {
        $selkatulos2_sel = ' SELECTED';
}   elseif ($selkatulos == 'K3') {                  
        $selkatulos3_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K4') {
        $selkatulos4_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K5') {                  
        $selkatulos5_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K6') {
        $selkatulos6_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K7') {                  
        $selkatulos7_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K8') {
        $selkatulos8_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K9') {                  
        $selkatulos9_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K10') {
        $selkatulos10_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K11') {                  
        $selkatulos11_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K12') {
        $selkatulos12_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K13') {                  
        $selkatulos13_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K14') {
        $selkatulos14_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K15') {                  
        $selkatulos15_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K16') {
        $selkatulos16_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K17') {                  
        $selkatulos17_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K18') {
        $selkatulos18_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K19') {                  
        $selkatulos19_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K20') {
        $selkatulos20_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K21') {                  
        $selkatulos21_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K22') {
        $selkatulos22_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K23') {                  
        $selkatulos23_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K24') {
        $selkatulos24_sel = ' SELECTED';                          
}   elseif ($selkatulos == 'K25') {                  
        $selkatulos25_sel = ' SELECTED';                          
} else {}                                                   
//---------------------------------SELKATULOS PART END--------------

//---------------------------------SELKA_HUOM PART BEGIN--------------
                                                                               
    //Initialize selka_huom variables                            

$selkahuom0_sel = '';
$selkahuom1_sel = '';

    //Setting existing values from db for form field default
                                                            
if ($selka_huom == 'FALSE') {                            
        $selkahuom0_sel = ' SELECTED';                            
}   elseif ($selka_huom == 'TRUE') {                  
        $selkahuom1_sel = ' SELECTED';                          
} else {}                                                   
//---------------------------------SELKA_HUOM PART END--------------


//---------------------------------SELKA_VAARAIKA PART BEGIN--------------
                                                                               
    //Initialize selka_vaaraika variables                            

$selkaika0_sel = '';
$selkaika1_sel = '';

    //Setting existing values from db for form field default
                                                            
if ($selka_vaaraika == 'FALSE') {                            
        $selkaika0_sel = ' SELECTED';                            
}   elseif ($selka_vaaraika == 'TRUE') {                  
        $selkaika1_sel = ' SELECTED';                          
} else {}                                                   
//---------------------------------SELKA_VAARAIKA PART END--------------


//---------------------------------POLVITULOS PART BEGIN--------------
                                                                               
    //Initialize polvitulos variables                            

$polvitulos0_sel = '';
$polvitulos1_sel = '';
$polvitulos2_sel = '';

    //Setting existing values from db for form field default
                                                            
if ($polvitulos == '0') {                            
        $polvitulos0_sel = ' SELECTED';                            
}   elseif ($polvitulos == '1') {                  
        $polvitulos1_sel = ' SELECTED';            
}   elseif ($polvitulos == '2') {
        $polvitulos2_sel = ' SELECTED';                          
} else {}                                                   
//---------------------------------POLVITULOS PART END--------------




