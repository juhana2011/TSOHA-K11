<?php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
Atomik::flash('Sinun pit�� kirjautua ulos voidaksesi rekister&ouml;ity&auml;','error');
	Atomik::redirect('index');
}