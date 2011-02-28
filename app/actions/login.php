<?php
				//Check if user is logged in or not, if yes, throw error and direct to index page
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		Atomik::flash('Olet jo kirjautunut sis&auml;&auml;n','error');
		Atomik::redirect('index');
}