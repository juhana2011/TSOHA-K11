<?php
		//Limit query result if user non-admin, show only dogs with status OK
		//Get the search criterias from POST and query from database
		if(isset($_SESSION['username']) && (isset($_SESSION['password']) && ($_SESSION['usergroup'] == 1))) {
			if ($_POST['submit'] == 'Hae'){
				$_POST['koirulit'] = Atomik_Db::query('select * from koiralistausview where reknro LIKE ? and nimi LIKE ? and vari LIKE ?',array($_POST['hkreknro'].'%',$_POST['hknimi'].'%',$_POST['hkvari'].'%'));
			}
			}else { 
				if ($_POST['submit'] == 'Hae') {
					$_POST['koirulit'] = Atomik_Db::query('select * from koiralistausview where koiran_tila = 1 and reknro LIKE ? and nimi LIKE ? and vari LIKE ?',array($_POST['hkreknro'].'%',$_POST['hknimi'].'%',$_POST['hkvari'].'%')); 
		//Check if something found, if not, throw error and redirect to listdogs page
				}
			}
	if ($_POST['koirulit']->rowCount() == 0){
		Atomik::Flash('<strong>HAULLASI EI OSUMIA !</strong>');
		Atomik::redirect('listdogs');
	}