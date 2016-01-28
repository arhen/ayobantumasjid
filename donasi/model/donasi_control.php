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
			// header("location:".PSN."login");
			echo"<script> alert('Proses Pengiriman berhasil'); </script>";
			header("location: ../sukses.php");
		} else {
			echo"<script> alert('Proses Pengiriman gagal. Coba Lagi!'); </script>";
			header("location: ../index.php");
		}
		

?>