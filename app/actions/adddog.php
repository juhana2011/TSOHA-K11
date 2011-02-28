<?php
				//Dog addition, first check if user is logged in
if (!isset($_SESSION['username'])){
Atomik::flash('Et ole kirjautunut sis&auml;&auml;n','error');
	Atomik::redirect('login');
} else {}

