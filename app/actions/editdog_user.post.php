<?php
				//If pressed button Muuta, proceed
      if ($_POST['nappula'] == 'Muuta') { 
				// Set a custom error message if required field information is missing
		Atomik::set('app/filters/required_message', '%s on pakollinen tieto !');

		// Set needed filters for form field information validity check to
		// avoid problems when inserting them into database
		$rule = array(
			'reknro' =>		array('filter' => '/(FIN|FI)\d{5}\/\d{2}/',
							'required' => true,
							'message' => 'rekisterinumero vaarin'),
			'nimi' => array('filter' => '/.{0,40}/',
							'required' => true,
							'message' => 'Koiran nimi puuttuu tai liian pitk&auml;'),
			'syntynyt' =>	array('filter' => '/(\d{1}|\d{2})\.(\d{1}|\d{2})\.\d{4}/',
							'required' => true,
							'message' => 'Syntym&auml;aika tulee olla muotoa P.K.VVVV'),
			'vari' =>		array('filter' => '/.{0,25}/',
							'required' => true,
							'message' => 'Koiran v&auml;ri puuttuu tai liian pitk&auml;'),
			'isa' =>		array('filter' => '/.{0,40}/',
							'required' => true,
							'message' => 'Koiran is&auml; puuttuu tai liian pitk&auml;'),
			'ema' =>		array('filter' => '/.{0,40}/',
							'required' => true,
							'message' => 'Koiran em&auml; puuttuu tai liian pitk&auml;'),
			'rotu' =>		array('filter' => '/.{0,33}/',
							'required' => true,
							'message' => 'Koiran rotu puuttuu tai liian pitk&auml;'),
			'omistaja' =>	array('filter' => 'validate_email',
							'required' => true,
							'message' => 'email-osoite vaarin'),
			'koiran_tila' =>array('filter' => '/.{0,2}/',
							'required' => true,
							'message' => 'Koiran tilatieto puuttuu tai liian pitk&auml;'),
			'selkatulos' => array('filter' => '/.{0,3}/',
							'required' => false,
							'message' => 'Koiran selk&auml; puuttuu tai liian pitk&auml;'),
			'selka_huom' => array('filter' => '/0|1|2|3|\s/',
							'required' => false,
							'message' => 'Koiran selkä_huom-tieto puuttuu tai liian pitk&auml;'),
			'selka_vaaraika' => array('filter' => '/0|1|2|3|\s/',
							'required' => false,
							'message' => 'Koiran nimi puuttuu tai liian pitk&auml;'),
			'polvitulos' => array('filter' => '/0|1|2|3|4|5|\s/',
							'required' => false,
							'message' => 'Koiran polvitulos v&auml;&auml;rin'),
			'nayttelytulos' => array('filter' => '/.{0,9}/',
							'required' => true,
							'message' => 'Koiran n&auml;yttelytulos puuttuu tai liian pitk&auml;'),
			'koetulos_lut' => array('filter' => '/.{0,9}/',
							'required' => false,
							'message' => 'Koiran LUT-tulos puuttuu tai liian pitk&auml;'),
			'koetulos_maaj' => array('filter' => '/.{0,10}/',
							'required' => false,
							'message' => 'Koiran M&Auml;AJ-tulos puuttuu tai liian pitk&auml;'),
			'koetulos_lume' => array('filter' => '/.{0,9}/',
							'required' => false,
							'message' => 'Koiran LUME-tulos puuttuu tai liian pitk&auml;'),
			'koetulos_veri' => array('filter' => '/.{0,9}/',
							'required' => false,
							'message' => 'Koiran VERI-tulos puuttuu tai liian pitk&auml;'),
            'koetulos_pika' => array('filter' => '/.{0,5}/',
							'required' => false,
							'message' => 'Koiran PIKA-tulos puuttuu tai liian pitk&auml;'),
			'koetulos_meja' => array('filter' => '/.{0,7}/',
							'required' => false,
							'message' => 'Koiran MEJ&Auml;-tulos puuttuu tai liian pitk&auml;'),
            'koetulos_vahi' => array('filter' => '/.{0,5}/',
							'required' => false,
							'message' => 'Koiran VAHI-tulos puuttuu tai liian pitk&auml;'),
            'koetulos_hirvj' => array('filter' => '/.{0,6}/',
							'required' => false,
							'message' => 'Koiran HIRVJ-tulos puuttuu tai liian pitk&auml;'),
			);
			
				// Comparison of POST and rule variables to avoid problems,Framework's own
			if (($data = Atomik::filter($_POST, $rule)) === false) {
	  			Atomik::flash(A('app/filters/messages'), 'error');
	  		return;
			}
	 	 
				// Create two separate array variables for inserting data into two separate tables      
			$perustiedot = array_slice($data, 0,9, true);
			$tulostiedot = array_slice($data, 9,13, true);
			
				// Data insert into database tables after validation procedures
				// If succesful, informs user that all ok
			Atomik_Db::update('koirat', $perustiedot,array('reknro' => $perustiedot['reknro']));
			Atomik_Db::update('koirien_tulokset', $tulostiedot,array('koira' => $perustiedot['reknro']));

			Atomik::flash('Koiran tiedot muutettu onnistuneesti!', 'success');
			Atomik::redirect('listdogs');
} 