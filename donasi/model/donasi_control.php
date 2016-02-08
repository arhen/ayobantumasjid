<?php
		require 'class.php';
		require '../../assets/extra/phpmailer/PHPMailerAutoload.php';

		if(isset($_POST['simpan'])) {
			$nama = $_POST['nama'];
			$nop = $_POST['nop'];
			
			$email = $_POST['email'];
			$jumlah = $_POST['jumlah'];
			$bank = $_POST['bank'];
			// $bukti ='';

			if(isset($_FILES['bukti']['name'])) {
				$bukti = $libs->uploadImageToFolder('../assets/img/bukti/',$_FILES['bukti']);	//upload
			}else {
				$bukti = $libs->uploadImageToFolder('../assets/img/bukti/', ROOT);	//upload
			}

			$prior = $donasi->tarikPrioritas();
			foreach ($prior as $prior) {
				if ($prior['prior']==1) {
					$id_proyek = $prior['id_proyek'];
				}
			}
			$donasi->tambahData($id_proyek,$nama,$nop,$email,$bukti,$jumlah,$bank);

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
			<p><i>Terima kasih atas notifikasi donasi yang telah anda berikan pada kami.\r\n
				Email ini menunjukan bahwa form donasi anda telah terkirim ke database kami
				dan akan segera di konfirmasi.</i></p>
			<p><i>Jika data yang anda berikan benar, maka kami akan mengirimkan notifikasi e-mail
				selanjutnya mengenai keabsahan data anda.</i></p>
			<br>
			<p><i>salam Hangat,</i></p>
			<p><b>Tim Yayasan Ayo Bantu Masjid</b></p>
			<br>
			<hr>
			<p><i>Perhatian!, Email ini adalah email otomatis dari sistem ayobantumasjid.com.
			anda tidak diperkenankan untuk membalas email ini.</i></p>
			<br>";
			$mail->AltBody = "Ini adalah informasi balasan dari kegiatan saat memasukan data form donasi di
								form donasi ayobantumasjid.com/donasi";

			if(!$mail->send()) 
			{
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
			    echo "Message has been sent successfully";
			}

			// header("location:".PSN."login");
			echo"<script> alert('Proses Pengiriman berhasil'); </script>";
			header("location: ../sukses.php");
		} else {
			echo"<script> alert('Proses Pengiriman gagal. Coba Lagi!'); </script>";
			header("location: ../index.php");
		}
		

?>
