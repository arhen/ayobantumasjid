<?php

class home_model{
	private $db;
	public function __construct($database){
		$this->db = $database;
	}

	public function tarikData(){

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
											tbl_prior.id_proyek_sukses,
											tbl_prior.prior from tbl_proyek INNER JOIN tbl_prior ON 
											tbl_proyek.id_proyek=tbl_prior.id_proyek");
		try{
			$query->execute();
		}catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	
}
?>