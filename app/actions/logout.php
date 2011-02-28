<?php
				//Logout procedure by unset the session variables 
	if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
		Atomik::flash('Olet jo kirjautunut ulos tai et viel&auml; kirjautunut sis&auml;&auml;n','error');
		Atomik::redirect('index');
	}
				//Here below the actual unset flow
	unset($_SESSION['username']); 
	unset($_SESSION['password']);
	unset($_SESSION['usergroup']);
	unset($_SESSION['email']);
				//If succesful, give a ok message and direct to index page
	Atomik::flash('Uloskirjautuminen onnistui !','success');
	Atomik::redirect('index');
