<?php
				//Registration page, first check if user logged in, if not, throw away
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		Atomik::flash('Sinun pit&auml;&auml; kirjautua ulos voidaksesi rekister&ouml;ity&auml;','error');
		Atomik::redirect('index');
	}