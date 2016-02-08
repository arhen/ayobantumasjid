 <?php 
session_start();
if($_REQUEST['model']): // for secure single file
ob_start();
date_default_timezone_set('Asia/Jakarta');

require '../../libs/path.php';
require '../../model/class.php';
require '../../../assets/extra/phpmailer/PHPMailerAutoload.php';

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

		//Notifikasi email ke pihak donator

			$mail = new PHPMailer;

			//Enable SMTP debugging. 
			$mail->SMTPDebug = 3;                               
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();            
			//Set SMTP host name                          
			$mail->Host = "mail.i-khalifah.com";
			//Set this to true if SMTP host requires authentication to send email
			$mail->SMTPAuth = true;                          
			//Provide username and password     
			$mail->Username = "info@i-khalifah.com";                 
			$mail->Password = "Rahmat031194'";                           
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tsl";                           
			//Set TCP port to connect to 
			$mail->Port = 587;          

			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);                         

			$mail->From = "no-reply@ayobantumasjid.com";
			$mail->FromName = "Yayasan Ayo Bantu Masjid";

			$mail->addAddress($email, $nama);

			$mail->isHTML(true);

			$mail->Subject = "Notifikasi Form Donasi | Yayasan Ayo Bantu Masjid";
			$mail->Body = "
			<p><i>Hi!</i></p>
			<br>
			<p><i>Terima kasih atas donasi yang telah anda berikan. Donasi anda telah kami
			verifikasi dan dikonfirmasi. </i></p>
			<p><i>JData donasi anda telah masuk dalam sistem databases kami. Untuk melihatnya
			silahkan kunjungi www.ayobantumasjid.com/data-donasi/ </i></p>
			<br>
			<p><i>salam Hangat,</i></p>
			<p><b>Tim Yayasan Ayo Bantu Masjid</b></p>
			<br>
			<hr>
			<p><i>Perhatian!, Email ini adalah email otomatis dari sistem ayobantumasjid.com.
			anda tidak diperkenankan untuk membalas email ini.</i></p>
			<br>";
			$mail->AltBody = "Ini adalah informasi mengenai konfirmasi data donasi yang telah
			masuk ke databases ayobantumasjid.com";

			if(!$mail->send()) 
			{
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
			    echo "Message has been sent successfully";
			}

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
