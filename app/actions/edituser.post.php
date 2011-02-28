<?php
				//If pressed button Muuta, start the post operation
if ($_POST['nappula'] == 'Muuta') { 
				// Set a custom error message if required field information is missing
		Atomik::set('app/filters/required_message', '%s on pakollinen tieto !');

				//Check if password is changed in form or not
		if ($salasana != ($_POST['salasana'])) {
			$password = md5($_POST['salasana']);
			$password_repeat = md5($_POST['salasana_toisto']);
		}else {
		$password = $_POST['salasana'];
		$password_repeat = $_POST['salasana_toisto'];
		}
				//Check if password written twice is matching -> if not, throw error
		if ($password != $password_repeat) {
			Atomik::flash('Kirjoittamasi salasanat eiv&auml;t t&auml;sm&auml;&auml;','error');
			return;
		}
				// Set a custom error message if required field information is missing
		Atomik::set('app/filters/required_message', '%s on pakollinen tieto !');


				// Set needed filters for form field information validity check to
				// avoid problems when inserting them into database
		$rule = array(
			'nimi' =>			array('filter' => '/.{0,40}/',
								'required' => true,
								'message' => 'Nimi puuttuu tai liian pitk&auml;'),
			'osoite' =>			array('filter' => '/.{0,70}/',
								'required' => true,
								'message' => 'Osoite liian pitk&auml;'),  
				//Note here below the regular expression, not the finest, but did it myself :)
			'puhelinnumero' =>	array('filter' => '/([0-9]{2}[-?|\s?][0-9]{6,10})|([0-9]{3}[-?|\s?][0-9]{4,9})|([0-9]{4}[-?\s?][0-9]{4,8})|([0-9]{7,12})/',
								'required' => true,
								'message' => 'Kirjoita puhelinnumero yhteen ilman v&auml;lily&ouml;ntej&auml;'),			
			'email' =>			array('filter' => 'validate_email',
								'required' => true,
								'message' => 'email-osoite vaarin'),
			'kayttajatunnus' =>	array('required' => true,
								'message' => 'Salasana liian pitk&auml;'),
            'salasana' =>		array('required' => true,
								'message' => 'Salasana puuttuu;'),
			'kayttajaryhma' =>	array('filter' => '/d{0,3}/',
								'required' => true),
		);
		
				// Comparison of POST and rule variables to avoid problems,framework's own
		if (($data = Atomik::filter($_POST, $rule)) === false) {
			Atomik::flash(A('app/filters/messages'), 'error');
		return;
		}
				//Change data array's value of pwd to hashed ones or correct one
		$data['salasana'] = $password;
				
				// Data insert into database after validation procedures
				// If succesful, informs user that all ok
		Atomik_Db::update('kayttajat',$data,array('email' => $data['email']));
		Atomik::flash('Tiedot p&auml;ivitetty onnistuneesti!', 'success');
		Atomik::redirect('listusers');
			
				//If pressed Poista button, remove this user from system, in db cascade delete,so it takes care of that side
}elseif ($_POST['nappula'] == 'Poista') {
			Atomik_Db::delete('kayttajat', array('email' => $_POST['email']));
			Atomik::flash('Kayttaja poistettu j&auml;rjestelm&auml;st&auml; onnistuneesti!', 'success');
			Atomik::redirect('listusers');
}
 

