<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
Atomik::flash('Olet jo kirjautunut ulos tai et viel&auml; kirjautunut sis&auml;&auml;n','error');
	Atomik::redirect('index');
}

unset($_SESSION['username']); 
unset($_SESSION['password']);
unset($_SESSION['usergroup']);
unset($_SESSION['email']);

Atomik::flash('Uloskirjautuminen onnistui !','success');
		Atomik::redirect('index');
