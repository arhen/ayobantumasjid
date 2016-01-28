<?php
class proyek_model{
	private $db;
	public function __construct($database){
		$this->db = $database;
	}

	public function tarikData(){

		$query = $this->db->prepare("SELECT * from tbl_donasi order by id DESC");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		
	
	public function tarikDataNonKonfirm($id){
		$sql = "SELECT * from `tbl_donasi` where `id_proyek` = :id_proyek and konfirmasi = 0";
		$query = $this->db->prepare($sql);
			$query->bindParam(':id_proyek', $id,PDO::PARAM_INT);
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	// public function tarikDataKonfirm($id){
	// 	$sql = "SELECT * from tbl_donasi where 'id_proyek' = ? AND 'konfirmasi' = 1";
	// 	$query = $this->db->prepare($sql);
	// 		$query->bindParam(1, $id,PDO::PARAM_INT);
	// 		try{
	// 			$query->execute();
	// 		}catch(PDOException $e){
	// 			die($e->getMessage());
	// 		}
	// 	return $query->fetchAll(PDO::FETCH_ASSOC);
	// }
	public function tarikDataKonfirm($id){
		$sql = "SELECT * from `tbl_donasi` where `id_proyek` = :id_proyek and konfirmasi = 1";
		$query = $this->db->prepare($sql);
			$query->bindParam(':id_proyek', $id,PDO::PARAM_INT);
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}



	public function tarikDataByIdProyek($id){
		// $sql = "SELECT * from tbl_donasi INNER JOIN tbl_proyek ON tbl_donasi.id_proyek = ";
	    $query = $this->db->prepare("SELECT SUM(jumlah) from tbl_donasi WHERE id_proyek = '$id' AND konfirmasi = 1 ");
		
		// $sql = "SELECT jumlah FROM tbl_donasi, tbl_proyek WHERE tbl_donasi.id_proyek = ?";
		// $query = $this->db->prepare($sql);
		// $query->bindParam(1, $id,PDO::PARAM_INT);

		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function tarikDataById($id){
		// $sql = "SELECT * from tbl_donasi INNER JOIN tbl_proyek ON tbl_donasi.id_proyek = ";
	    $query = $this->db->prepare("SELECT * from tbl_donasi WHERE id = '$id' ");

		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch(PDO::FETCH_ASSOC);
	}


	public function hapusDataById($id){
			$sql="DELETE FROM `tbl_donasi` WHERE `id` = ?";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $id,PDO::PARAM_INT);
			
			try{
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
		
	}
	
	public function ubahKonfirmasi($id){

		$query = $this->db->prepare("UPDATE `tbl_donasi` SET 	konfirmasi = '1'
																where id = :id
		");
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}

	}

	public function ubahDataDonasi($nama,$nop,$email,$jumlah,$id){
		$query = $this->db->prepare("UPDATE tbl_donasi SET nama = :nama,
																nop	= :nop,
																email = :email,
																jumlah = :jumlah
																WHERE id	= :id

		");
		$query->bindParam(':nama',$nama,PDO::PARAM_STR);
		$query->bindParam(':nop',$nop,PDO::PARAM_STR);
		$query->bindParam(':id',$id,PDO::PARAM_INT);
		$query->bindParam(':email',$email);
		$query->bindParam(':jumlah',$jumlah);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
		}		
	} 
}
?>