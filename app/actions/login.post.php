<?php
 // Reads and hashes values from POST name and POST password to local variables
$name = md5($_POST['name']);
$password = md5($_POST['password']);

echo $name;
echo $password;

			//Queries a row from db what matches with name&password combination
$result = Atomik_Db::find('kayttajat',array('kayttajatunnus' => $name,'salasana' => $password,'kayttajaryhma' => $usergroup));
    		

    

			//If name and password ok, result is one row, correct-var is set 1, else it is set 0
    if ($result -> rowCount() == 1){
		$_SESSION('username') = $result['kayttajatunnus'];
		$_SESSION('usergroup') = $result['kayttajaryhma'];
    }else { 
		Atomik::flash('K&auml;ytt&auml;j&auml;tunnus ja/tai salasana virheellinen!','success');
		Atomik::redirect('login');
	}
		
		
    }





?>
