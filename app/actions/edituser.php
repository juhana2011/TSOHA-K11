<?php
				//Action for administrators, user editing
				//First check that user is logged in
if(!isset($_SESSION['username']) && (!isset($_SESSION['password']))) {
	Atomik::flash('Et ole kirjautunut sis&auml;&auml;n;','error');
	Atomik::redirect('login');
}
				//Then check if user is admin or not -> if not, throw away
if ($_SESSION['usergroup'] != 1) {
	Atomik::flash('K&auml;ytt&ouml;oikeutesi eiv&auml;t riit&auml; - tarkoitettu vain yll&auml;pit&auml;jille;','error');
	Atomik::redirect('index');
}
$users = Atomik_Db::query('select * from kayttajat where kayttajat.email=?',array($_GET['email']));

				//Initialize and set this user's information from array to variables
foreach ($users as $user):
$kayttaja_id = $user['kayttaja_id'];
$nimi = $user['nimi'];
$osoite = $user['osoite'];
$puhelinnumero = $user['puhelinnumero'];
$email = $user['email'];
$kayttajaryhma = $user['kayttajaryhma'];
$kayttajatunnus = $user['kayttajatunnus'];
$salasana = $user['salasana'];
endforeach;
