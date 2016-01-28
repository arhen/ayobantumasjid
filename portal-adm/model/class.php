<?php 
ob_start();
require_once("config/database.php");
function autoload($class){

	$namafile = $class.'.php';

	include_once $namafile;

}

spl_autoload_register('autoload');

try{
	$libs 		= new libs_model();
	$home 		= new home_model($db);
	$proyek 	= new proyek_model($db);
	$proyek2 	= new proyek_model($db);
	$proyek3 	= new proyek_model($db);
	$proyek4 	= new proyek_model($db);
	$users	 	= new users_model($db);
}
catch(Exception $e){
	echo "Menemukan kesalahan : ".$e->getMessage()."\n";
}

?>