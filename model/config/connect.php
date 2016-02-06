<?php 

	/* Ganti :
		192.168.23.168 	= dengan ip server ayobantumasjid.com
		abm 			= dengan username databases
		ayobantumasjid	= dengan Password databases

	*/
	// $db = new PDO('mysql:host=localhost; dbname=u0722209_abm;charset=utf8','u0722209_abm','ayobantumasjid');
	// $db = new PDO('mysql:host=localhost; dbname=db_abm;charset=utf8','root','');
	$db = new PDO('mysql:host=192.168.23.16; dbname=db_abm;charset=utf8','abm','ayobantumasjid');

	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
