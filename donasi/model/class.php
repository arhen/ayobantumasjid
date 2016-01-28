<?php 
ob_start();
require_once("config/connect.php");
function autoload($class){

	$namafile = $class.'.php';

	include_once $namafile;

}

spl_autoload_register('autoload');

try{
	$libs 		= new libs_model();
	$donasi 	= new donasi($db);
}
catch(Exception $e){
	echo "Menemukan kesalahan : ".$e->getMessage()."\n";
}

?>