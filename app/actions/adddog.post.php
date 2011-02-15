<?php
	
	$rule = array(
	    'reknro' => array('filter' => '/(FIN|FI)\d{5}\/\d{2}/',
			      'required' => true,
			      'message' => 'rekisterinumero vaarin'),
	    'nimi' => array('required' => true),
	    'syntynyt' => array('required' => true),
            'vari' => array('required' => true),
            'isa' => array('required' => true),
            'ema' => array('required' => true),
            'rotu' => array('required' => true),
            'omistaja' => array('filter' => 'validate_email',
				'required' => true,
				'message' => 'email-osoite vaarin'),
            'koiran_tila' => array('required' => true),
	    'selkatulos' => array('required' => true),			     
	    'selka_huom' => array('required' => true),
	    'selka_vaaraika' => array('required' => true),
            'polvitulos' => array('required' => true),
            'nayttelytulos' => array('required' => true),
            'koetulos_lut' => array('required' => true),
            'koetulos_maaj' => array('required' => true),
            'koetulos_lume' => array('required' => true),
            'koetulos_veri' => array('required' => true),
            'koetulos_pika' => array('required' => true),
            'koetulos_meja' => array('required' => true),
            'koetulos_vahi' => array('required' => true),
            'koetulos_hirvj' => array('required' => true)
	);
	
        	    
	if (($data = Atomik::filter($_POST, $rule)) === false) {
	  Atomik::flash(A('app/filters/messages'), 'error');
	  return;
	}
	       
	$perustiedot = array_slice($data, 0,9, true);
	$tulostiedot = array_slice($data, 9,13, true);
				
	Atomik_Db::insert('koirat', $perustiedot);
	Atomik_Db::insert('koirien_tulokset', $tulostiedot);

	Atomik::flash('Koira lisätty onnistuneesti!', 'success');
	

        
   

