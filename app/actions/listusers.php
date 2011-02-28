<?php
			//Check if login or not
	if(!isset($_SESSION['username']) && (!isset($_SESSION['password']))) {
		Atomik::flash('Et ole kirjautunut sis&auml;&auml;n;','error');
		Atomik::redirect('login');
	}

			//Check if user is administrator -> if not, throw away
	if ($_SESSION['usergroup'] != 1) {
		Atomik::flash('K&auml;ytt&ouml;oikeutesi eiv&auml;t riit&auml; - tarkoitettu vain yll&auml;pit&auml;jille;','error');
		Atomik::redirect('index');
	}
	//Fetch all the user information from database table kayttajat
	$users = A('db:select * from kayttajat;');


