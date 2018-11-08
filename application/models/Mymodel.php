<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model{
	public function insert($tabel,$data){
		$this->db->insert($tabel,$data);
	}
	public function tambahProduksi($kode, $jumlah){
		$kodeproduksi=$query=$this->mymodel->makeKodeProduksi();
		$tanggal=$this->mymodel->now("%Y-%m-%d");
		$this->db->query("INSERT INTO produksi VALUES($kodeproduksi,'$kode','$tanggal',$jumlah)");
	}
	public function tambahRoti($kode,$nama,$harga,$waktu){
		$this->db->query("INSERT INTO masterroti VALUES('$kode','$nama','$harga','$waktu')");
	}
	public function GetMRoti(){
		$data = $this->db->query("SELECT * FROM masterroti");
		return $data->result_array();
	}
	public function GetProduksi(){
		$data = $this->db->query("SELECT * FROM produksi ORDER BY kodeproduksi DESC");
		return $data->result_array();
	}
	public function GetRoti(){
		$this->load->model('mymodel');
		$now=$this->mymodel->now("%Y-%m-%d");
		$data = $this->db->query("SELECT kodeproduksi,produksi.koderoti,tglproduksi,SUM(jumlah) as stok,waktukadaluarsa,namaroti,hargasatuan FROM produksi LEFT JOIN masterroti ON produksi.koderoti=masterroti.koderoti WHERE '$now'<DATE_FORMAT((tglproduksi+waktukadaluarsa), '%Y-%m-%d') GROUP BY produksi.koderoti");
		return $data;
	}
	public function countRoti($koderoti){
		$this->load->model('mymodel');
		$now=$this->mymodel->now("%Y-%m-%d");
		$data = $this->db->query("SELECT SUM(jumlah) as jml,tglproduksi,waktukadaluarsa FROM produksi LEFT JOIN masterroti ON produksi.koderoti=masterroti.koderoti WHERE produksi.koderoti='$koderoti' AND '$now'<DATE_FORMAT((tglproduksi+waktukadaluarsa), '%Y-%m-%d')");
		$jml=0;
		foreach($data->result_array() as $dt){
			$jml=$dt['jml'];
		}
		return $jml;
	}
	public function macamRoti(){
		$data = $this->db->query("SELECT COUNT(*) as jml FROM masterroti");
		$jml=0;
		foreach($data->result_array() as $dt){
			$jml=$dt['jml'];
		}
		return $jml;		
	}
	public function kurangiRoti($koderoti,$jml){
		$this->load->model('mymodel');
		$now=$this->mymodel->now("%Y-%m-%d");
		$data = $this->db->query("SELECT kodeproduksi,produksi.koderoti,tglproduksi,jumlah,waktukadaluarsa FROM produksi LEFT JOIN masterroti ON produksi.koderoti=masterroti.koderoti WHERE produksi.koderoti='$koderoti' AND '$now'<DATE_FORMAT((tglproduksi+waktukadaluarsa), '%Y-%m-%d')");
		$jumlah=$jml;
		foreach($data->result_array() as $dt){
			$ikoderoti=$dt['koderoti'];
			$ikodeproduksi=$dt['kodeproduksi'];
			$ijumlah=$dt['jumlah'];
			if($jumlah<=$ijumlah){
				$sisa=$ijumlah-$jumlah;
				$jumlah=0;
				$this->db->query("UPDATE produksi SET jumlah=$sisa WHERE kodeproduksi='$ikodeproduksi'");
			}else{
				$sisa=0;
				$jumlah-=$ijumlah;
				$this->db->query("UPDATE produksi SET jumlah=$sisa WHERE kodeproduksi='$ikodeproduksi'");
			}
		}		
		if($jumlah!=0){
			echo "Terjadi Error";
		}
	}
	public function editMasterRoti($kode){
		$data = $this->db->query("SELECT * FROM masterroti WHERE koderoti='$kode'");
		return $data->result_array();
	}
	public function editProduksi($kode){
		$data = $this->db->query("SELECT * FROM produksi WHERE kodeproduksi=$kode");
		return $data->result_array();
	}
	public function editRoti($kode,$k,$n,$h,$w){
		$this->db->query("UPDATE masterroti SET koderoti='$k',namaroti='$n',hargasatuan=$h,waktukadaluarsa=$w WHERE koderoti='$kode'");
	}
	public function deleteRoti($kode){
		$this->db->query("DELETE FROM masterroti WHERE koderoti='$kode'");
	}
	public function makeKodeProduksi(){
		$tanggal=0;
		$num=0;
		$tgl=$this->db->query('SELECT CONVERT(DATE_FORMAT(now(), "%Y%m%d"),int) as now')->result_array();
		$query=$this->mymodel->queryNgendas();
		$qn=$this->db->query($query)->result_array();
		foreach($tgl as $t){
			$tanggal=$t['now'];
		}
		foreach($qn as $q){
			$num=$q['num'];
		}
		$num=$num+1;
		if($num>=10){
			$k=$tanggal.$num;
		}else{
			$k=$tanggal."0".$num;
		}
		return $k;
	}
	public function makeTransaksiDetil($kodetransaksi){
		$num=$this->db->query("SELECT * FROM transaksi_detil WHERE kodetransaksi='".$kodetransaksi."'")->num_rows();
		$num++;
		if($num>=10){
			$k=$kodetransaksi.$num;
		}else{
			$k=$kodetransaksi."0".$num;
		}
		return $k;
	}
	public function queryNgendas(){
		return 'SELECT kodeproduksi, CONVERT((kodeproduksi-MOD(kodeproduksi,100))/100,int) as tanggal, MOD(kodeproduksi,100) as num, CONVERT(DATE_FORMAT(now(), "%Y%m%d"),int) as now FROM produksi WHERE CONVERT((kodeproduksi-MOD(kodeproduksi,100))/100,int)=CONVERT(DATE_FORMAT(now(), "%Y%m%d"),int) ORDER BY kodeproduksi';
	}
	public function now($format){
		$tanggal="0000-00-00";
		$tgl=$this->db->query('SELECT DATE_FORMAT(now(), "'.$format.'") as now')->result_array();
		foreach($tgl as $t){
			$tanggal=$t['now'];
		}
		return $tanggal;
	}
	public function cekUser($u,$role){
		if($role=="pegawai"){
			$data = $this->db->query("SELECT * FROM user WHERE username='$u'");
			return $data->first_row();
		}else{
			$data = $this->db->query("SELECT * FROM member WHERE username='$u'");
			return $data->first_row();
		}
	}
	public function update($tabel,$data,$where){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}
	public function query($q){
		return $this->db->query($q);
	}
}
?>