<?php
			// Reads and hashes values from POST name and POST password to local variables
		$name = md5($_POST['username']);
		$password = md5($_POST['password']);

			//Queries a row from db what matches with name&password combination
		$tulos=Atomik_Db::findAll('kayttajat',array('kayttajatunnus' => $name,'salasana' => $password));
		
			//Sets the found user's information into variables
		foreach($tulos as $yksi):
			$usergroup = $yksi['kayttajaryhma'];
			$userid = $yksi['kayttajatunnus'];
			$pwd = $yksi['salasana'];
			$email = $yksi['email'];
		endforeach;

			//If name and password ok, result is one row, give success message, else give error
			//Evaluates also the usergroup information, what is needed later on
	if($tulos->rowCount() == 1 && !empty($usergroup)) {
		$_SESSION['username']  = $userid;
		$_SESSION['password']  = $pwd;
		$_SESSION['usergroup'] = $usergroup;
		$_SESSION['email'] = $email; 
		Atomik::flash('Kirjautuminen onnistui !','success');
		Atomik::redirect('index');
	}else {
			Atomik::flash('K&auml;ytt&auml;j&auml;tunnus ja/tai salasana virheellinen!','error');
			Atomik::redirect('login');
	}