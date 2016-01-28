<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADMIN | Ayo Bantu Masjid</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="asset/js/html5.js"></script>
    <![endif]-->

    <!-- core js files -->
    <script src="../asset/js/jquery-1.11.0.min.js"></script>
    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/modernizr.custom.js"></script>
    <script src="asset/js/core.js"></script>
    <!-- core js files -->

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/font-awesome.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/login.css">


    <link rel="stylesheet" href="../asset/css/plugins/chosen/chosen.css">
    <script src="../asset/js/plugins/chosen.jquery.min.js"></script>


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="container">
    <div class="row vertical-center-row">
        <form id='login' action="" method="post">
            <div id="loginarea">
                <h6>Halaman Login</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="image">
                            <img src="../asset/img/loginavatar.png" class="img-responsive img-rounded" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required />
                        </div>

							<?php 
								// require 'core/class.php';
								 if(isset($_POST['login'])){
									 
								require("../model/class.php"); 
								require("../libs/path.php"); 
								 $uss = empty($_POST['username'])?'':htmlentities($_POST['username'],ENT_QUOTES,'utf-8');
								 $pas = empty($_POST['password'])?'':filter_var($_POST['password'], FILTER_SANITIZE_STRING);
								 $username = filter_var($uss,FILTER_SANITIZE_STRING);
								 $username = filter_var($uss,FILTER_SANITIZE_MAGIC_QUOTES);
								 
								 
								 $pass     = filter_var($pas,FILTER_SANITIZE_MAGIC_QUOTES);
								// pastikan username dan password adalah berupa huruf atau angka.

								//if (password_verify("2d8cc94a8c8b5ca7400969c5b2e572c1", '$2y$10$ae2xru0nX494I8pnCZlj2Og/eeBCP.eZeHjF/dOiUr582FTECokpK')) {}// membandingkan pass yang di client dan hash di server
								$user = $users->getUserByUsername($username);

									$count=0;

								//if (password_verify($pass, $user['password'])) {
									if ($pass == $user['password']) {
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
									  // $_SESSION['level']    		= $user['level'];
									  // $_SESSION['nopeg']   			= $user['nip'];

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
										 echo ($model == 'proyek')? ">":" ";

										header("location:".URL);
									}
									else{
										echo "Username dan password tidak sesuai";
									}

								 }
							
							?>

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <input type="submit" name="login" class="btn btn-success" value="login">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>