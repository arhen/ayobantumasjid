 <?php 
session_start();
if($_REQUEST['model']): // for secure single file
ob_start();
date_default_timezone_set('Asia/Jakarta');

require '../../libs/path.php';
require '../../model/class.php';

$model=$_GET['model'];

$method=$_GET['method'];


// echo $method;
// echo $parameter;

if($model=='proyek' AND $method=='konfirm' ){
	$id = filter_var($_GET['id'],FILTER_VALIDATE_INT);

	$proyek->ubahKonfirmasi($id);
}

if($model=='proyek' AND $method=='ubah' ){
	if(isset($_POST['simpan'])){
		$nama = $_POST['nama'];
		$nama = filter_var(strip_tags($nama), FILTER_SANITIZE_MAGIC_QUOTES); // sanitasi 
		$nop = trim($_POST['nop']);
		$email = $_POST['email'];
		$jumlah = $_POST['jumlah'];
		$id = $_POST['id'];

		$proyek->ubahDataDonasi($nama,$nop,$email,$jumlah,$id);
		echo"<script> alert('Mengubah data berhasil'); </script>";
		
	}
}


if($model=='proyek' AND $method=='hapus' ){
	$id = filter_var($_GET['id'],FILTER_VALIDATE_INT);

	$proyek->hapusDataById($id);
}


echo"<script> history.go(-2); </script>";
 // echo"<script> alert('Menambah data'); </script>";
 
 endif;
?>