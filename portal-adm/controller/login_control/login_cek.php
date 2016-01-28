<?php 
// require 'core/class.php';
 
 $uss = empty($_POST['username'])?'':$_POST['username'];
 $pas = empty($_POST['pass'])?'':filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
 $username = filter_var($uss,FILTER_SANITIZE_MAGIC_QUOTES);
 $pass     = filter_var($pas,FILTER_SANITIZE_STRING);
// pastikan username dan password adalah berupa huruf atau angka.


  // header('location:login.php?login=false');

//if (password_verify("2d8cc94a8c8b5ca7400969c5b2e572c1", '$2y$10$ae2xru0nX494I8pnCZlj2Og/eeBCP.eZeHjF/dOiUr582FTECokpK')) {}// membandingkan pass yang di client dan hash di server
$user = $users->getUserByUsername($username);

	$count=0;

if (password_verify($pass, $user['password'])) {
	// Verified echo
	
echo 	$count=$users->authUser($username);// login
	

}	

// Apabila username dan password ditemukan
if ($count > 0){
	  @session_start();
	  // include "timeout.php";
	  $_SESSION['username']    		= $user['username'];
	  $_SESSION['nama_lengkap'] 	= $user['nama_lengkap'];
	  $_SESSION['password']    		= $user['password'];
	  $_SESSION['level']    		= $user['level'];
	  $_SESSION['nopeg']   			= $user['nip'];

	  // session timeout
	  $_SESSION['login'] = 1;
	  
	  $libs->timer();
	
	  $_SESSION['timeout'];
 	  
	  $libs->cek_login();
		// echo "<br/>";

	 	$sid_lama = session_id();
		
		session_regenerate_id();

		// echo "<br/>";

 	 	$sid_baru = session_id();
		
		$users->setSessionUser($username,$sid_baru); // update session id pada user

		header("location:".URL."");
	}
	else{
		// echo "<script>alert('Password  Salah');</script>";
		
		header('location:login/?login=false');
	
	}


?>