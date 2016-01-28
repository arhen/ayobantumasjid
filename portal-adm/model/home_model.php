<?php

class home_model{
	private $db;
	public function __construct($database){
		$this->db = $database;
	}

	public function tambahData($nama_proyek,$desc_proyek,$target_dana,$gambar,$tanggal_selesai){
		$query = $this->db->prepare("INSERT INTO tbl_proyek SET nama_proyek = :nama_proyek,
																desc_proyek	= :desc_proyek,
																target_dana = :target_dana,
																gambar		= :gambar,
																tanggal_selesai = :tanggal_selesai

		");
		$query->bindParam(':nama_proyek',$nama_proyek,PDO::PARAM_STR);
		$query->bindParam(':desc_proyek',$desc_proyek,PDO::PARAM_STR);
		$query->bindParam(':target_dana',$target_dana,PDO::PARAM_INT);
		$query->bindParam(':gambar',$gambar);
		$query->bindParam(':tanggal_selesai',$tanggal_selesai);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
		}		
	}

	public function ubahDataProyek($nama_proyek,$desc_proyek,$target_dana,$gambar,$tanggal_selesai,$id_proyek){
		$query = $this->db->prepare("UPDATE tbl_proyek SET nama_proyek = :nama_proyek,
																desc_proyek	= :desc_proyek,
																target_dana = :target_dana,
																gambar		= :gambar,
																tanggal_selesai = :tanggal_selesai
																WHERE id_proyek	= :id_proyek

		");
		$query->bindParam(':nama_proyek',$nama_proyek,PDO::PARAM_STR);
		$query->bindParam(':desc_proyek',$desc_proyek,PDO::PARAM_STR);
		$query->bindParam(':target_dana',$target_dana,PDO::PARAM_INT);
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		$query->bindParam(':gambar',$gambar);
		$query->bindParam(':tanggal_selesai',$tanggal_selesai);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
		}		
	}

	public function tarikData(){

		$query = $this->db->prepare("SELECT * from tbl_proyek order by id_proyek DESC");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}

	public function tarikDataPrior(){

		$query = $this->db->prepare("SELECT tbl_proyek.id_proyek, 
											tbl_proyek.nama_proyek,
											tbl_proyek.desc_proyek,
											tbl_proyek.target_dana,
											tbl_proyek.gambar,
											tbl_proyek.total,
											tbl_proyek.presentase,
											tbl_proyek.tanggal_selesai,
											tbl_proyek.konfirm,
											tbl_prior.id,
											tbl_prior.prior from tbl_proyek INNER JOIN tbl_prior ON 
											tbl_proyek.id_proyek=tbl_prior.id_proyek");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function tarikDataAktif(){

		$query = $this->db->prepare("SELECT * from tbl_proyek WHERE konfirm = 'Y' order by id_proyek DESC");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	public function tarikDataNonAktif(){

		$query = $this->db->prepare("SELECT * from tbl_proyek WHERE konfirm = 'N' order by id_proyek DESC");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	
	public function tarikDataById($id_proyek){
		$sql = "SELECT * from tbl_donasi where 'id_proyek' = :id_proyek";
		$query = $this->db->prepare($sql);
		$query->bindParam(':id_proyek', $id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function tarikDataByIdProyek($id_proyek){
		$sql = "SELECT * from tbl_proyek where id_proyek = :id_proyek";
		$query = $this->db->prepare($sql);
		$query->bindParam(':id_proyek', $id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch(PDO::FETCH_ASSOC);
	}

	public function tarikNamaProyek($id_proyek){
		$sql = "SELECT nama_proyek from tbl_proyek where id_proyek = :id_proyek";
		$query = $this->db->prepare($sql);
		$query->bindParam(':id_proyek', $id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetch(PDO::FETCH_ASSOC);
	}


	public function hapusDataById($id_proyek){
	
			// $sql = "DELETE * from tbl_proyek where 'id_proyek' = :id_proyek";
		    $sql="DELETE FROM `tbl_proyek` WHERE `id_proyek` = ?";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $id_proyek,PDO::PARAM_INT);
			
			try{
				$query->execute();
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
		
	}
	
	public function ubahData($id_proyek,$total){

		$query = $this->db->prepare("UPDATE `tbl_proyek` SET total = :total where id_proyek = :id_proyek");

		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		$query->bindParam(':total',$total,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function UbahDataSelesai($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_proyek` SET konfirm = 'Y' where id_proyek = :id_proyek");

		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function UbahDataBelumSelesai($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_proyek` SET konfirm = 'N' where id_proyek = :id_proyek");

		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}



	public function ubahKonfirmasi($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_proyek` SET status = '1'
																where id_proyek = :id_proyek
		");
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function ubahDataPrioritas($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_prior` SET id_proyek = :id_proyek
																WHERE id = 1;
		");
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function ubahPrioritas($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_prior` SET prior = 1,
															id_proyek = :id_proyek
																WHERE id = 1;
		");
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function ubahPriorSukses($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_prior` SET id_proyek_sukses = :id_proyek_sukses
																WHERE id = 1;
		");
		$query->bindParam(':id_proyek_sukses',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function batalPrioritas($id_proyek){

		$query = $this->db->prepare("UPDATE `tbl_prior` SET prior = 0
																WHERE id_proyek = :id_proyek;
		");
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_INT);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
	}
	}

	public function tarikPrioritas(){

		$query = $this->db->prepare("SELECT * from tbl_prior WHERE id = 1");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}


	
}
?>