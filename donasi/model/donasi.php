<?php
class donasi{
	private $db;
	public function __construct($database){
		$this->db = $database;
	}

	
	public function tambahData($id_proyek,$nama,$nop,$email,$bukti,$jumlah,$bank){
		
		$query = $this->db->prepare("INSERT INTO `tbl_donasi` SET id_proyek = :id_proyek,	
																nama = :nama,
																email = :email, 
																bukti = :bukti,
																bank = :bank,
																jumlah = :jumlah,
																nop = :nop
		");
		$query->bindParam(':id_proyek',$id_proyek,PDO::PARAM_STR);
		$query->bindParam(':nama',$nama,PDO::PARAM_STR);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':nop',$nop,PDO::PARAM_STR);
		$query->bindParam(':bukti',$bukti);
		$query->bindParam(':bank',$bank);
		$query->bindParam(':jumlah',$jumlah);
		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
		return	die($e->getMessage());
		
		}		
	}

	public function tarikData(){
	$query = $this->db->prepare("SELECT * from tbl_donasi order by id desc");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);


		}

	public function tarikDataDonatur(){
		$query = $this->db->prepare("SELECT * from tbl_donasi WHERE konfirmasi = 1 order by id desc");
			try{
				$query->execute();
			}catch(PDOException $e){
				die($e->getMessage());
			}
			return $query->fetchAll(PDO::FETCH_ASSOC);
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