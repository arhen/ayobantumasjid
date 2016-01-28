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

if($model=='home' AND $method=='tambah' ){
	if(isset($_POST['simpan'])){
		$nama_proyek = $_POST['nama_proyek'];
		$nama_proyek = filter_var(strip_tags($nama_proyek), FILTER_SANITIZE_MAGIC_QUOTES); // sanitasi 
		$desc_proyek = trim($_POST['desc_proyek']);
		$target_dana = $_POST['target_dana'];
		$tanggal_selesai = (date('Y-m-d',strtotime($_POST['selesai'])));

		if(isset($_FILES['file']['name'])){

			// $gambar = $libs->uploadImage($_FILES['file']);	
			$gambar = $libs->uploadImageToFolder('../../../assets/images/proyek/',$_FILES['file']);	
			
		}

		$home->tambahData($nama_proyek,$desc_proyek,$target_dana,$gambar,$tanggal_selesai);
		echo"<script> alert('Menambah data'); </script>";
		
	}
}

if($model=='home' AND $method=='ubah' ){
	if(isset($_POST['simpan'])){
		$nama_proyek = $_POST['nama_proyek'];
		$nama_proyek = filter_var(strip_tags($nama_proyek), FILTER_SANITIZE_MAGIC_QUOTES); // sanitasi 
		$desc_proyek = trim($_POST['desc_proyek']);
		$gambar = $_POST['gambar'];
		$id_proyek = $_POST['id_proyek'];
		$target_dana = $_POST['target_dana'];
		$tanggal_selesai = (date('Y-m-d',strtotime($_POST['selesai'])));


		if(!empty($_FILES['file']['name'])){
			
			// $libs->hapusFile($gambar);
					
			$libs-> hapusGambarSpesific("../../../assets/images/proyek/",$gambar);

			
			$gambar = $libs->uploadImageToFolder('../../../assets/images/proyek/',$_FILES['file']);	
			
		
		}


		$home->ubahDataProyek($nama_proyek,$desc_proyek,$target_dana,$gambar,$tanggal_selesai,$id_proyek);
		echo"<script> alert('Mengubah data'); </script>";
		
	}
}

if ($model=='home' AND $method=='terapkan' ){

		$id = filter_var($_GET['id_proyek'],FILTER_VALIDATE_INT);
		
		$home->ubahPrioritas($id);
}

if ($model=='home' AND $method=='selesai' ){

		$id = filter_var($_GET['id_proyek'],FILTER_VALIDATE_INT);
		
		$home->ubahDataSelesai($id);
		$home->batalPrioritas($id);
		$cek = $home->tarikDataPrior();
		foreach ($cek as $cek) {
			if ($cek['total']>$cek['target_dana']) {
				$home->ubahPriorSukses($cek['id_proyek']);
			}
		}
}

if ($model=='home' AND $method=='nselesai' ){

		$id = filter_var($_GET['id_proyek'],FILTER_VALIDATE_INT);
		
		$home->ubahDataBelumSelesai($id);
}

if ($model=='home' AND $method=='batalprior' ){

		$id = filter_var($_GET['id_proyek'],FILTER_VALIDATE_INT);
		
		$home->batalPrioritas($id);
}


if ($model=='home' AND $method=='hapus' ){

		$id = filter_var($_GET['id_proyek'],FILTER_VALIDATE_INT);
		$cek = $home->tarikPrioritas();
		foreach ($cek as $cek) {
			if ($id==$cek['id_proyek'] AND $cek['prior']==1) {
				$home->batalPrioritas($id);
			}
			if ($id==$cek['id_proyek']) {
				$home->ubahDataPrioritas($cek['id_proyek_sukses']);
			}
		}
		$home->hapusDataById($id);

}


header("location:".URL."");
 // echo"<script> alert('Menambah data'); </script>";
 
 endif;
?>