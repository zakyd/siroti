<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rotiqu extends CI_Controller {
	public function index()
	{
		redirect('rotiqu/home');
	}
	public function home()
	{
		$this->load->model('mymodel');
		$roti = $this->mymodel->GetRoti()->result_array();
		$roti = array('roti' => $roti);
		$this->load->view('home',$roti);
	}
	public function pemesanan()
	{
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member")){	
			$this->load->model('mymodel');
			$roti = $this->mymodel->GetRoti()->result_array();
			$roti = array('roti' => $roti);
			if($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir"){	
				$this->load->view('pemesanan',$roti);
			}else{
				$this->load->view('mpemesanan',$roti);
			}
		}else{
			redirect('rotiqu/home');
		}
	}
	public function login()
	{
		if(!(isset($_SESSION['username']))){
			$this->load->view('login');
		}else{
			redirect('rotiqu/home');
		}
	}
	public function struk()
	{
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member")){	
			$this->load->model('mymodel');
			$macam = $this->mymodel->GetRoti()->num_rows();
			$roti = $this->mymodel->GetRoti()->result_array();
			$mroti = $this->mymodel->GetMRoti();
			$valid=0;
			foreach($roti as $roti){
				$iroti=$roti['koderoti'];
				$proti=$this->input->post("$iroti");
				$sroti=$this->mymodel->countRoti("$iroti");
				if($proti<=$sroti AND $proti>=0){
					$valid++;
				}
			}
			if($macam==$valid){
				$pemesan=$_SESSION['username'];
				$kodetransaksi=$this->mymodel->now("%Y%m%d%h%i%s").$pemesan;
				$totalharga=0;
				foreach($mroti as $mroti){
					$iroti=$mroti['koderoti'];
					$proti=$this->input->post("$iroti");
					if($proti>0){
						$harga=$mroti['hargasatuan']*$proti;
						$this->mymodel->kurangiRoti($iroti,$proti);
						$kodetransaksidetil=$this->mymodel->makeTransaksiDetil($kodetransaksi);
						$datadetil=array(
							'kodetransaksidetil' => $kodetransaksidetil,
							'kodetransaksi' => $kodetransaksi,
							'koderoti' => $iroti,
							'jmlroti' => $proti,
							'harga' => $harga
						);
						$this->mymodel->insert('transaksi_detil',$datadetil);
						$totalharga=$totalharga+$harga;
					}
				}
				$data=array(
					'kodetransaksi' => $kodetransaksi,
					'kodepemesan' => $pemesan,
					'tglpembelian' => $this->mymodel->now("%Y-%m-%d"),
					'totalharga' => $totalharga
				);
				$this->mymodel->insert('transaksi',$data);
				$rt=$this->mymodel->query("SELECT transaksi_detil.koderoti,jmlroti,harga,namaroti FROM transaksi_detil LEFT JOIN masterroti ON transaksi_detil.koderoti=masterroti.koderoti WHERE kodetransaksi='$kodetransaksi'")->result_array();
				$dt=array(
					'kodetransaksi' => $kodetransaksi,
					'kodepemesan' => $pemesan,
					'tglpembelian' => $this->mymodel->now("%Y-%m-%d"),
					'totalharga' => $totalharga,
					'rt' => $rt
				);
				$this->load->view('struk',$dt);
				//redirect('rotiqu/pemesanan');
			}else{
				echo "Terjadi Error";
			}
		}else{
			redirect('rotiqu/home');
		}
	}
	public function tambahroti()
	{
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){	
			$this->load->model('mymodel');
			$mroti = $this->mymodel->GetMRoti();
			$mroti = array('mroti' => $mroti);
			$this->load->view('tambahroti',$mroti);
		}else{
			redirect('rotiqu/home');
		}
	}
	public function tambahproduksi(){
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur")){	
			$this->load->model('mymodel');
			$pro = $this->mymodel->GetProduksi();
			$mroti = $this->mymodel->GetMRoti();
			$data = array(
				'pro' => $pro,
				'mroti' => $mroti
			);
			$this->load->view('tambahproduksi',$data);
		}else{
			redirect('rotiqu/home');
		}
	}
	public function troti(){
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){	
			$k=$_POST['koderoti'];
			$n=$_POST['namaroti'];
			$h=$_POST['hargasatuan'];
			$w=$_POST['waktukadaluarsa'];
			if($k!="" and $n!="" and $h!="" and $w!="" and $h>=0 and $w>=0){
				$this->load->model('mymodel');
				$this->mymodel->tambahRoti($k,$n,$h,$w);
				redirect('rotiqu/tambahroti');
			}else{
				redirect('rotiqu/tambahroti');
			}
		}else{
			redirect('rotiqu/home');
		}
	}
	public function tproduksi(){
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur")){	
			$k=$_POST['koderoti'];
			$j=$_POST['jumlah'];
			if($k!="" and $j!="" and $j>=0){
				$this->load->model('mymodel');
				$this->mymodel->tambahProduksi($k,$j);
				redirect('rotiqu/tambahproduksi');
			}else{
				redirect('rotiqu/tambahproduksi');
			}
		}else{
			redirect('rotiqu/home');
		}
	}
	public function editmroti($kode){
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){	
			$this->load->model('mymodel');
			$mroti = $this->mymodel->editMasterRoti($kode);
			$kode=""; $nama=""; $harga=0; $waktu=0;
			foreach($mroti as $mroti){
				$kode=$mroti['koderoti'];
				$nama=$mroti['namaroti'];
				$harga=$mroti['hargasatuan'];
				$waktu=$mroti['waktukadaluarsa'];
			}
			$data = array(
				'kode' => $kode,
				'nama' => $nama,
				'harga' => $harga,
				'waktu' => $waktu
			);
			$this->load->view('editroti',$data);
		}else{
			redirect('rotiqu/home');
		}
	}
	public function editproduksi($kode){
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur")){	
			$this->load->model('mymodel');
			$pro = $this->mymodel->editProduksi($kode);
			$mroti = $this->mymodel->GetMRoti();
			$kp=""; $kr=""; $tgl=0; $jml=0;
			foreach($pro as $p){
				$kp=$p['kodeproduksi'];
				$kr=$p['koderoti'];
				$tgl=$p['tglproduksi'];
				$jml=$p['jumlah'];
			}
			$data = array(
				'kp' => $kp,
				'kr' => $kr,
				'tgl' => $tgl,
				'jml' => $jml,
				'mroti' => $mroti
			);
			$this->load->view('editproduksi',$data);
		}else{
			redirect('rotiqu/home');
		}
	}
	public function eproduksi($kode){
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){
			$t=$_POST['tglproduksi'];
			$k=$_POST['koderoti'];
			$j=$_POST['jumlah'];
			if($k!="" and $j!="" and $t!=""){
				$this->load->model('mymodel');
				$where=array(
					'kodeproduksi' => $kode
				);
				$data=array(
					'koderoti' => $k,
					'tglproduksi' => $t,
					'jumlah' => $j
				);
				$this->mymodel->update('produksi',$data,$where);
				redirect('rotiqu/tambahproduksi');
			}else{
				redirect('rotiqu/tambahproduksi');
			}
		}else{
			redirect('rotiqu/home');
		}
		
	}
	public function deletemroti($kode){
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){
			$this->load->model('mymodel');
			$this->mymodel->deleteRoti($kode);
			redirect('rotiqu/tambahroti');
		}else{
			redirect('rotiqu/home');
		}
	}
	public function deleteproduksi($kode){
		if(isset($_SESSION['role']) AND ($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur")){
			$this->load->model('mymodel');
			$this->mymodel->query("DELETE FROM produksi WHERE kodeproduksi='$kode'");
			redirect('rotiqu/tambahproduksi');
		}else{
			redirect('rotiqu/home');
		}
	}
	public function ceklogin(){
		if(isset($_POST['username']) and isset($_POST['password'])){
			$u=$_POST['username'];
			$p=$_POST['password'];
			$r=$_POST['role'];
			$this->load->model('mymodel');
			$user=$this->mymodel->cekUser($u,$r);
			if($user->username==$u and $user->password==$p){
				$_SESSION['username']=$user->username;
				$_SESSION['namalengkap']=$user->namalengkap;
				if($r=="pegawai"){
					$_SESSION['role']=$user->level;
				}else{
					$_SESSION['role']="member";
				}
				redirect('rotiqu/home');
			}else{
				redirect('rotiqu/login');
			}
		}else{
			redirect('rotiqu/login');
		}
	}
	public function logout(){
		session_destroy();
		redirect('rotiqu/home');
	}
	public function laporan(){
		$this->load->model('mymodel');
		if(isset($_SESSION['role']) AND $_SESSION['role']=="admin"){
			if(isset($_POST['bln']) and isset($_POST['thn'])){
				$bln=$_POST['bln'];
				$bln++;
				$thn=$_POST['thn'];
			}else{
				$bln=(int)$this->mymodel->now("%m");
				$thn=(int)$this->mymodel->now("%Y");
			}
			$tanggal1=(int)date('Ymd', strtotime('01-'.$bln.'-'.$thn));
			$tanggal2=(int)date('Ymd', strtotime('01-'.($bln+1).'-'.$thn));
			//echo $tanggal1."\n".$tanggal2;
			$lap=$this->mymodel->query("SELECT transaksi_detil.koderoti, namaroti, SUM(jmlroti) as jml, SUM(harga) as harga FROM transaksi_detil LEFT JOIN masterroti ON transaksi_detil.koderoti=masterroti.koderoti WHERE CONVERT(LEFT(kodetransaksi,8),int)>=$tanggal1 AND CONVERT(LEFT(kodetransaksi,8),int)<$tanggal2 GROUP BY transaksi_detil.koderoti")->result_array();
			$bulan=array(
				'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$data=array(
				'lap' => $lap,
				'bulan' => $bulan,
				'bln' => $bln,
				'thn' => $thn
			);
			$this->load->view('laporan',$data);
		}else{
			redirect('rotiqu/home');
		}
	}
	public function coba(){
		$this->load->model('mymodel');
		if(isset($_POST['bln']) and isset($_POST['thn'])){
			$bln=$_POST['bln'];
			$thn=$_POST['thn'];
		}else{
			$bln=(int)$this->mymodel->now("%m");
			$thn=(int)$this->mymodel->now("%Y");
		}
		$tanggal1=date('Ymd', strtotime('01-'.$bln.'-'.$thn));
		echo $tanggal1;
	}
}
