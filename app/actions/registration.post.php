<?php
				//Registration post prcedure, reads info from post vars and passes on after certain checking 
		
		$password = md5($_POST['salasana']);
		$password_repeat = md5($_POST['salasana_toisto']);
		if ($password != $password_repeat) {
			Atomik::flash('Kirjoittamasi salasanat eiv&auml;t t&auml;sm&auml;&auml;','error');
		return;
		}
				//Check if the username or email already exist in database, if true->error and new registration attempt
		$tarkasta_ktunnus = Atomik_Db::query('select * from kayttajat where kayttajatunnus=?',array($_POST['kayttajatunnus']));
		$tarkasta_email = Atomik_Db::query('select * from kayttajat where email=?',array($_POST['email']));
		if ($tarkasta_ktunnus->rowCount() > 0) {
			Atomik::flash('Valitsemasi k&auml;ytt&auml;j&auml;tunnus on jo olemassa, valitse jokin toinen;','error');
			Atomik::redirect('registration');
		}elseif ($tarkasta_email->rowCount() > 0) {
			Atomik::flash('Valitsemasi s&auml;hk&ouml;postiosoite on jo olemassa, valitse jokin toinen;','error');
			Atomik::redirect('registration');
		}
				// Set a custom error message if required field information is missing
		Atomik::set('app/filters/required_message', '%s on pakollinen tieto !');
		
				// Set needed filters for form field information validity check to
				// avoid problems when inserting them into database
		$rule = array(
			'nimi' =>		array('filter' => '/.{0,40}/',
							'required' => true,
							'message' => 'Nimi puuttuu tai liian pitk&auml;'),
			'osoite' =>		array('filter' => '/.{0,70}/',
							'required' => true,
							'message' => 'Osoite liian pitk&auml;'),  
			'puhelinnumero' => array('filter' => '/([0-9]{2}[-?|\s?][0-9]{6,10})|([0-9]{3}[-?|\s?][0-9]{4,9})|([0-9]{4}[-?\s?][0-9]{4,8})|([0-9]{7,12})/',
							'required' => true,
							'message' => 'Kirjoita puhelinnumero yhteen ilman v&auml;lily&ouml;ntej&auml;'),
			'email' => array('filter' => 'validate_email',
							'required' => true,
							'message' => 'email-osoite vaarin'),
			'kayttajatunnus' => array('required' => true,
							'message' => 'Salasana liian pitk&auml;'),
							'salasana' => array('required' => true,
							'message' => 'Koiran em&auml; puuttuu tai liian pitk&auml;'),
			'kayttajaryhma' => array('filter' => '/d{0,3}/',
							'required' => true),
				);
		
				// Comparison of POST and rule variables to avoid problems,framework's own
		if (($data = Atomik::filter($_POST, $rule)) === false) {
			Atomik::flash(A('app/filters/messages'), 'error');
		return;
		}
				//Change data arrays values of user id and pwd to hashed ones
				//$data['kayttajatunnus'] = md5($_POST['kayttajatunnus']);
		$data['salasana'] = md5($_POST['salasana']);
				
				// Data insert into databaseafter validation procedures
				// If succesful, informs user that all ok
		Atomik_Db::insert('kayttajat',$data);
		Atomik::flash('Rekister&ouml;ityminen OK!', 'success');
		Atomik::redirect('login');
 