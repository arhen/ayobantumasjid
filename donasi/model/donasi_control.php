<?php
		require 'class.php';

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
			$to      = $email;
			$subject = 'Notifikasi Donasi dari Yayasan Ayo Bantu Masjid';
			$message = '
				<html>
				<head>
					<title> Pesan Notifikasi </title>
				</head>
				<body>
				<p>Halo.</p>
				<p>Terima kasih atas notifikasi donasi yang telah anda berikan pada kami.<p>
				<p>Email ini menunjukan bahwa form donasi anda telah terkirim ke database kami
				dan akan segera di konfirmasi.</p>
				<p>Jika data yang anda berikan benar, maka kami akan mengirimkan notifikasi e-mail
				selanjutnya mengenai keabsahan data anda.</p>
				<br>
				<p>Salam Hangat,</p>
				<p>Tim Yayasan Ayo Bantu Masjid,</p>
				</body>
				</html>
			';
			$headers = 'From: official.rahmatslamet@gmail.com' . "\r\n" .
			    'Reply-To: official.rahmatslamet@gmail.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $message, $headers);

			// header("location:".PSN."login");
			echo"<script> alert('Proses Pengiriman berhasil'); </script>";
			header("location: ../sukses.php");
		} else {
			echo"<script> alert('Proses Pengiriman gagal. Coba Lagi!'); </script>";
			header("location: ../index.php");
		}
		

?>
