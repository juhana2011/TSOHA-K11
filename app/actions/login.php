<?php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
Atomik::flash('Olet jo kirjautunut sis&auml;&auml;n','error');
	Atomik::redirect('index');
}