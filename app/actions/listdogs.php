<?php
				//First check if user is admin (admin sees dogs with all status'), if not, show only dogs with status OK
				//Database query to fetch all possible information what dogs can have in this system
	if(isset($_SESSION['username']) && (isset($_SESSION['password']) && ($_SESSION['usergroup'] == 1)))
	$dogs = A('db:select * from koiralistausview'); 
	else  
	$dogs = A('db:select * from koiralistausview where koiran_tila = 1');

