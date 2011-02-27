if (!isset($_SESSION['username'])) {
Atomik::flash('Et ole kirjautunut sis&auml;&auml;n,'error');
	Atomik::redirect('login');
} else {}