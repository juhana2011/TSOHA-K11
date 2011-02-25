<?php
 
$name = md5($_POST['name']);
$password = md5($_POST['password']);

echo $name;
echo $password;


$result = Atomik_Db::find('kayttajat',array('kayttajatunnus' => $name,'salasana' => $password ));
    Atomik::flash('OK', 'success');
		Atomik::redirect('index');

    $count = mysql_result( $result, 0, 0 );

			//If name and password ok, correct-var is set 1, else it is set 0
    if ($result->rowCount() == 1)
    { $correct = 1;

    } else { 
		$correct = 0;
    }


?>


?>
